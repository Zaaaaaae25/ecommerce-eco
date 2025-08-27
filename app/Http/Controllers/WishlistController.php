<?php

namespace App\Http\Controllers;
// app/Http/Controllers/WishlistController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        // Contoh: ambil data wishlist user login dari session/DB
        $ids = session('wishlist', []);              // [1,3,5]
        $sort = $request->get('sort', 'newest');     // newest|price-asc|price-desc|eco-desc
        $query = Product::whereIn('id', $ids);

        $query = match ($sort) {
            'price-asc'  => $query->orderBy('price','asc'),
            'price-desc' => $query->orderBy('price','desc'),
            'eco-desc'   => $query->orderBy('eco_score','desc'),
            default      => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();
        return view('wishlist', compact('products','sort'));
    }

    public function bulkAddToCart(Request $request)
    {
        $ids = $request->input('ids', []);
        // TODO: masukkan ke cart (session/DB) sesuai kebutuhan
        return back()->with('success', count($ids).' item ditambahkan ke cart.');
    }

    public function bulkRemove(Request $request)
    {
        $ids = $request->input('ids', []);
        $wishlist = collect(session('wishlist', []))->reject(fn($id)=>in_array($id,$ids))->values()->all();
        session(['wishlist'=>$wishlist]);
        return back()->with('success', count($ids).' item dihapus dari wishlist.');
    }

    public function toggle(Request $request)
    {
        $id = (int) $request->input('product_id');
        $wishlist = collect(session('wishlist', []));
        $wishlist = $wishlist->contains($id) ? $wishlist->reject(fn($x)=>$x==$id) : $wishlist->push($id);
        session(['wishlist'=>$wishlist->values()->all()]);
        return response()->json(['count'=>$wishlist->count()]);
    }
}
