<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // <-- wajib ditambahkan

class CartController extends Controller
{
    public function index()
    {
        // External data sources (public sample APIs)
        $productsResp   = Http::get('https://fakestoreapi.com/products?limit=6');
        $categoriesResp = Http::get('https://fakestoreapi.com/products/categories');
        $usersResp      = Http::get('https://jsonplaceholder.typicode.com/users?_limit=3');

        $products = $productsResp->successful() ? $productsResp->json() : [];
        $categories = $categoriesResp->successful() ? array_slice($categoriesResp->json(), 0, 4) : [];
        $users = $usersResp->successful() ? $usersResp->json() : [];

        $testimonials = array_map(function ($u) {
            return [
                'name' => $u['name'],
                'text' => 'Belanja mudah, produk sesuai deskripsi, dan kemasan ramah lingkungan. Akan kembali lagi.',
                'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($u['name']) . '&background=F0FFF4&color=276749',
            ];
        }, $users);

        // Kirim data ke view
        return view('cart', compact('products', 'categories', 'testimonials'));
    }
}
