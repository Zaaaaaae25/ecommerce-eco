<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Query params
        $selectedCategories = (array) $request->query('category', []); // array of category slugs
        $selectedMaterials  = (array) $request->query('material', []); // array of materials
        $priceRange         = $request->query('price');                // under-25|25-50|50-100|over-100
        $sort               = $request->query('sort', 'featured');     // featured|price-asc|price-desc|newest

        $query = Product::query();

        // Eager load category jika relasi ada
        if (method_exists(Product::class, 'category')) {
            $query->with('category');
        }

        // ====== FILTER: CATEGORIES ======
        if (!empty($selectedCategories)) {
            // Kita cek kolom yang tersedia di tabel products
            $hasCategorySlug = Schema::hasColumn('products', 'category_slug');
            $hasCategoryId   = Schema::hasColumn('products', 'category_id');
            $hasCategoryStr  = Schema::hasColumn('products', 'category'); // string nama kategori

            if ($hasCategorySlug) {
                $query->whereIn('category_slug', $selectedCategories);
            } elseif ($hasCategoryId) {
                // Convert slugs -> ids
                $ids = Category::whereIn('slug', $selectedCategories)->pluck('id');
                if ($ids->count()) {
                    $query->whereIn('category_id', $ids);
                } else {
                    // Tidak ada id yg cocok -> kosongkan hasil
                    $query->whereRaw('1=0');
                }
            } elseif ($hasCategoryStr) {
                // Convert slugs -> names
                $names = Category::whereIn('slug', $selectedCategories)->pluck('name');
                if ($names->count()) {
                    $query->whereIn('category', $names);
                } else {
                    $query->whereRaw('1=0');
                }
            }
            // Jika tak ada kolom kategori sama sekali, abaikan filter
        }

        // ====== FILTER: MATERIAL ======
        $hasMaterial = Schema::hasColumn('products', 'material');
        if ($hasMaterial && !empty($selectedMaterials)) {
            $query->whereIn('material', $selectedMaterials);
        }

        // ====== FILTER: PRICE ======
        if ($priceRange) {
            switch ($priceRange) {
                case 'under-25': $query->where('price', '<', 25); break;
                case '25-50':    $query->whereBetween('price', [25, 50]); break;
                case '50-100':   $query->whereBetween('price', [50, 100]); break;
                case 'over-100': $query->where('price', '>', 100); break;
            }
        }

        // ====== SORTING ======
        switch ($sort) {
            case 'price-asc':  $query->orderBy('price', 'asc'); break;
            case 'price-desc': $query->orderBy('price', 'desc'); break;
            case 'newest':     $query->latest('created_at'); break;
            case 'featured':
            default:
                $query->latest('created_at');
                break;
        }

        // ====== DATA UNTUK SIDEBAR ======
        $categories = Category::orderBy('name')->get(['name', 'slug']);

        // Materials hanya jika kolomnya memang ada
        $materials = collect();
        if ($hasMaterial) {
            $materials = Product::whereNotNull('material')
                ->select('material')
                ->distinct()
                ->orderBy('material')
                ->pluck('material');
        }

        $products = $query->paginate(12)->appends($request->query());

        return view('product', [
            'products'           => $products,
            'categories'         => $categories,
            'materials'          => $materials,
            'selectedCategories' => $selectedCategories,
            'selectedMaterials'  => $selectedMaterials,
            'priceRange'         => $priceRange,
            'sort'               => $sort,
        ]);
    }
     public function show(Product $product)
    {
        // Optional: kalau ada relasi kategori
        $product->loadMissing('category');

        // Normalisasi data agar view tetap jalan walau kolom berbeda
        $images = collect(data_get($product, 'images', []));
        if ($images->isEmpty()) {
            $fallback = data_get($product, 'image_url')
                ?? data_get($product, 'image')
                ?? 'https://images.unsplash.com/photo-1519744792095-2f2205e87b6f?q=80&w=1200&auto=format&fit=crop';
            $images = collect([$fallback]);
        }

        $sizes  = collect(data_get($product, 'sizes', ['S','M','L','XL']));
        $colors = collect(data_get($product, 'colors', ['#111827','#4B5563','#9CA3AF']));

        // Harga coret (jika ada)
        $compareAt = data_get($product, 'compare_at_price') ?? data_get($product, 'old_price');

        // Produk terkait (kategori sama, exclude current)
        $related = Product::query()
            ->when($product->category_id ?? null, fn($q) => $q->where('category_id', $product->category_id))
            ->whereKeyNot($product->getKey())
            ->latest('id')
            ->limit(5)
            ->get();

        // Reviews placeholder (silakan ganti dari tabel reviews kalau sudah ada)
        $reviews = collect(); // ->average('rating') dsb jika ada

        return view('product-detail', [
            'product'    => $product,
            'images'     => $images,
            'sizes'      => $sizes,
            'colors'     => $colors,
            'compare_at' => $compareAt,
            'related'    => $related,
            'reviews'    => $reviews,
        ]);
    }
}
