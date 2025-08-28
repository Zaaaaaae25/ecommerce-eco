<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q = Product::query();

        // === FILTER CATEGORY ===
        if ($cats = $request->input('category')) {
            $q->whereIn('category_slug', (array) $cats);
        }

        // === FILTER PRICE ===
        $price = $request->input('price');
        if ($price === 'under-25') {
            $q->where('price', '<', 25);
        } elseif ($price === '25-50') {
            $q->whereBetween('price', [25, 50]);
        } elseif ($price === '50-100') {
            $q->whereBetween('price', [50, 100]);
        } elseif ($price === 'over-100') {
            $q->where('price', '>', 100);
        }

        // === FILTER MATERIAL ===
        if ($materials = $request->input('material')) {
            $q->whereIn('material', (array) $materials);
        }

        // === SORT ===
        $sort = $request->input('sort', 'featured');
        if ($sort === 'price-asc') {
            $q->orderBy('price', 'asc');
        } elseif ($sort === 'price-desc') {
            $q->orderBy('price', 'desc');
        } elseif ($sort === 'newest') {
            $q->latest();
        } else {
            // default: featured (atau created_at sebagai fallback)
            $q->orderBy('created_at', 'desc');
        }

        // === PAGINATION ===
        $products = $q->paginate(24)->withQueryString();

        return view('product', compact('products', 'sort'));
    }
}