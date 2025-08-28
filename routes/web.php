<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\controllerprofile;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;

// Home & Profile
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [controllerprofile::class, 'index'])->name('profile');

// Product
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Cart
Route::get('/cart',  [CartController::class, 'index'])->name('cart.index');   // <-- GET
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');   // <-- POST needed by Blade
Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/apply-code', [CartController::class, 'applyCode'])->name('cart.apply-code');

// Wishlist (hapus duplikasi)
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/bulk-add-to-cart', [WishlistController::class, 'bulkAddToCart'])->name('wishlist.bulkAddToCart');
Route::delete('/wishlist/bulk-remove', [WishlistController::class, 'bulkRemove'])->name('wishlist.bulkRemove');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

// Auth (view)
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
