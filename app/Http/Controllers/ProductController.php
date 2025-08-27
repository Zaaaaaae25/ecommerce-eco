<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; //

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // ambil data product, bisa pakai pagination
        $products = Product::paginate(24);   // atau Product::all() kalau belum butuh paginate

        return view('product', compact('products'));
    }
}