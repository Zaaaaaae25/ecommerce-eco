<?php

namespace App\Http\Controllers;

use App\Models\Product; // Jangan lupa import model Product
use App\Models\Wishlist; // Jangan lupa import model Wishlist
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth; // Import Auth Facade

class WishlistController extends Controller
{
    /**
     * Menampilkan halaman wishlist milik user yang sedang login.
     */
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat wishlist.');
        }

        // Ambil semua item wishlist milik user yang sedang login
        // Eager load relasi 'product' untuk menghindari N+1 problem
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->latest()->get();

        // Kirim data ke view
        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Metode ini biasanya tidak digunakan untuk wishlist.
     * Item ditambahkan langsung dari halaman produk.
     */
    public function create()
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class WishlistController extends Controller
{
    protected function currentUser(): User
    {
        $user = Auth::user();
        if ($user) return $user;

        // Samakan pola guest dengan CartController
        return User::firstOrCreate(
            ['email' => 'guest@ecomart.local'],
            ['name' => 'Guest', 'password' => bcrypt(str()->random(12))]
        );
    }

    // GET /wishlist
    public function index(Request $request)
>>>>>>> 3edd9c4383a05f026460656cb34929f3a385b9c3
    {
        $user = $this->currentUser();
        $sort = in_array($request->get('sort'), ['newest','price-asc','price-desc','eco-desc'])
            ? $request->get('sort') : 'newest';

        $query = Product::select('products.*')
            ->join('wishlists', 'wishlists.product_id', '=', 'products.id')
            ->where('wishlists.user_id', $user->id);

        switch ($sort) {
            case 'price-asc':
                $query->orderBy('products.price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('products.price', 'desc');
                break;
            case 'eco-desc':
                $query->orderBy('products.eco_score', 'desc'); // sesuaikan jika kolom ini tidak ada
                break;
            case 'newest':
            default:
                $query->orderBy('wishlists.created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        // view kamu ada di resources/views/wishlist/index.blade.php
        return view('wishlist', compact('products', 'sort'));
    }

<<<<<<< HEAD
    /**
     * Menyimpan produk baru ke dalam wishlist.
     */
    public function store(Request $request)
    {
        // Validasi request, pastikan product_id ada
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan item ke wishlist.');
        }

        $userId = Auth::id();
        $productId = $request->product_id;

        // Cek apakah produk sudah ada di wishlist user
        $existingItem = Wishlist::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();

        if ($existingItem) {
            return back()->with('info', 'Produk ini sudah ada di wishlist Anda.');
        }

        // Jika belum ada, buat entri baru
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke wishlist!');
    }

    /**
     * Metode ini biasanya tidak digunakan.
     * Semua item ditampilkan di halaman index.
     */
    public function show(string $id)
=======
    // POST /wishlist/{product}/toggle
    public function toggle(Product $product)
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

    // DELETE /wishlist/bulk-remove
    public function bulkRemove(Request $request)
>>>>>>> 3edd9c4383a05f026460656cb34929f3a385b9c3
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer|exists:products,id',
        ]);

        $user = $this->currentUser();
        $user->wishlist()->detach($request->input('ids', []));

        return back()->with('success', 'Selected items removed from wishlist.');
    }

<<<<<<< HEAD
    /**
     * Metode ini tidak relevan untuk wishlist.
     */
    public function edit(string $id)
=======
    // POST /wishlist/bulk-add-to-cart
    public function bulkAddToCart(Request $request)
>>>>>>> 3edd9c4383a05f026460656cb34929f3a385b9c3
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
                    'cart_id' => $cart->id,
                    'product_id' => $pid,
                ]);
                $item->quantity = ($item->exists ? $item->quantity : 0) + 1;
                $item->save();
            }
        });

        // WishlistController@index
return view('wishlist', compact('products', 'sort'));

<<<<<<< HEAD
    /**
     * Metode ini tidak relevan untuk wishlist.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Menghapus item dari wishlist.
     */
    public function destroy(string $id)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menghapus item.');
        }

        // Cari item wishlist berdasarkan ID-nya
        $wishlistItem = Wishlist::find($id);

        // Jika item tidak ditemukan atau bukan milik user yang sedang login, beri error
        if (!$wishlistItem || $wishlistItem->user_id !== Auth::id()) {
            return back()->with('error', 'Item tidak ditemukan atau Anda tidak memiliki izin.');
        }

        // Hapus item
        $wishlistItem->delete();

        return back()->with('success', 'Produk berhasil dihapus dari wishlist.');
=======

>>>>>>> 3edd9c4383a05f026460656cb34929f3a385b9c3
    }
}
