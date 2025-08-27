<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Menampilkan produk berdasarkan kategori yang dipilih.
     */
    public function show(Category $category)
    {
        // Load produk yang berelasi dengan kategori ini,
        // beserta paginasi
        $products = $category->products()->latest()->paginate(12);

        // Kirim data kategori dan produknya ke view
        return view('categories.show', compact('category', 'products'));
    }
}
