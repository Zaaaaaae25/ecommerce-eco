<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class WishlistController extends Controller
{
    /** Ikuti pola guest seperti CartController (atau ganti ke middleware auth) */
    protected function currentUser(): User
    {
        $user = Auth::user();
        if ($user) return $user;

        return User::firstOrCreate(
            ['email' => 'guest@ecomart.local'],
            ['name' => 'Guest', 'password' => bcrypt(str()->random(12))]
        );
    }

    /** GET /wishlist */
    public function index(Request $request)
    {
        $user = $this->currentUser();
        $sort = in_array($request->get('sort'), ['newest','price-asc','price-desc','eco-desc'])
            ? $request->get('sort') : 'newest';

        $query = Product::select('products.*')
            ->join('wishlists', 'wishlists.product_id', '=', 'products.id')
            ->where('wishlists.user_id', $user->id);

        switch ($sort) {
            case 'price-asc':  $query->orderBy('products.price', 'asc'); break;
            case 'price-desc': $query->orderBy('products.price', 'desc'); break;
            case 'eco-desc':   $query->orderBy('products.eco_score', 'desc'); break; // pastikan kolomnya ada
            case 'newest':
            default:           $query->orderBy('wishlists.created_at', 'desc'); break;
        }

        $products = $query->paginate(12)->withQueryString();

        return view('wishlist', compact('products', 'sort'));
    }

    /** POST /wishlist/toggle/{product} */
    public function toggle(Product $product, Request $request)
    {
        $user = $this->currentUser();

        $exists = $user->wishlist()->where('product_id', $product->id)->exists();

        if ($exists) {
            $user->wishlist()->detach($product->id);
            $state = 'removed';
        } else {
            $user->wishlist()->attach($product->id);
            $state = 'added';
        }

        return response()->json([
            'ok'         => true,
            'state'      => $state,
            'product_id' => $product->id,
            'count'      => $product->wishlistedBy()->count(),
        ]);
    }

    /** DELETE /wishlist/{product} */
    public function destroy(Product $product)
    {
        $user = $this->currentUser();
        $user->wishlist()->detach($product->id);
        return back()->with('success', 'Removed from wishlist.');
    }

    /** DELETE /wishlist/bulk-remove */
    public function bulkRemove(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:products,id',
        ]);

        $user = $this->currentUser();
        $user->wishlist()->detach($request->input('ids', []));

        return back()->with('success', 'Selected items removed from wishlist.');
    }

    /** POST /wishlist/bulk-add-to-cart */
    public function bulkAddToCart(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:products,id',
        ]);

        $user = $this->currentUser();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $productIds = $request->input('ids', []);

        DB::transaction(function () use ($cart, $productIds) {
            foreach ($productIds as $pid) {
                $item = CartItem::firstOrNew([
                    'cart_id'    => $cart->id,
                    'product_id' => $pid,
                ]);
                $item->quantity = ($item->exists ? $item->quantity : 0) + 1;
                $item->save();
            }
        });

        return back()->with('success', 'Dipindahkan ke cart.');
    }
}
