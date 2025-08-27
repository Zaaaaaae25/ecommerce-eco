<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\controllerprofile;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;


Route::post('/cart/apply-code', [CartController::class, 'applyCode'])
    ->name('cart.apply-code');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [controllerprofile::class, 'index'])->name('profile');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// routes/web.php
Route::get('/wishlist', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/bulk-add-to-cart', [\App\Http\Controllers\WishlistController::class, 'bulkAddToCart'])->name('wishlist.bulkAddToCart');
Route::delete('/wishlist/bulk-remove', [\App\Http\Controllers\WishlistController::class, 'bulkRemove'])->name('wishlist.bulkRemove');
Route::post('/wishlist/toggle', [\App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle'); // add/remove single

Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');

// routes/web.php
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
