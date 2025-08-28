<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth routes (login, register, etc.)
Auth::routes();

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Grup route untuk profil yang memerlukan login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Halaman Produk (Shop)
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Route untuk CRUD Produk (admin)
Route::resource('products', ProductController::class);

// Route untuk Kategori
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Route untuk Keranjang Belanja (Cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'add'])->name('cart.store');
Route::post('/cart/apply-code', [CartController::class, 'applyCode'])->name('cart.apply-code');

// Route untuk Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist')->middleware('auth');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store')->middleware('auth');
Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy')->middleware('auth');
