<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(6)->get();
        
        // GANTI BARIS INI
        // Dari: $categories = Category::pluck('name');
        // Menjadi:
        $categories = Category::all(); // <-- INI PERBAIKANNYA

        $testimonials = Testimonial::latest()->take(3)->get();

        // Stats
        $stats = [
            'customers' => User::count(),
            'satisfaction' => "95%", // bisa dari survey table
            'delivered' => Order::where('status','completed')->count(),
        ];

        return view('welcome', compact('products','categories','testimonials','stats'));
    }
}
