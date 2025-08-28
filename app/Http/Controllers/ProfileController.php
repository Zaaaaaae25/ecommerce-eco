<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $wishlistItems = $user->wishlists()->with('product')->get();
        $orders = $user->orders()->latest()->get();
        $testimonials = $user->testimonials()->latest()->get();
        $cartItems = session('cart', []);

        return view('profile', compact(
            'user',
            'wishlistItems',
            'orders',
            'testimonials',
            'cartItems'
        ));
    }
}