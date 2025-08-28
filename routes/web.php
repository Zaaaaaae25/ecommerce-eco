<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\controllerprofile;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;


// Home & Profile
Route::get('/', [HomeController::class, 'index'])->name('home');

// Product
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Cart
Route::get('/cart',  [CartController::class, 'index'])->name('cart.index');   // <-- GET
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');   // <-- POST needed by Blade
Route::patch('/cart/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{item}', [CartController::class, 'destroy'])->name('cart.remove');
Route::post('/cart/apply-code', [CartController::class, 'applyCode'])->name('cart.apply-code');


// Auth (view)
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');


// Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

// ✅ Tambahan bulk actions:
Route::delete('/wishlist/bulk-remove', [WishlistController::class, 'bulkRemove'])
    ->name('wishlist.bulk-remove');

Route::post('/wishlist/bulk-add-to-cart', [WishlistController::class, 'bulkAddToCart'])
    ->name('wishlist.bulkAddToCart'); // <— samakan dengan yg dipanggil di Blade

    Route::get('/products/{product:slug}', [ProductController::class, 'show'])
    ->name('products.show');

Route::view('/about', 'about')->name('about');
