<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Auth routes (login, register, etc.)
Auth::routes();

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dan menjadi seperti ini
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// Halaman Produk (untuk menampilkan semua produk di halaman 'Shop')
Route::get('/product', [ProductController::class, 'index'])->name('product.index');

// Route untuk CRUD Produk (admin)
Route::resource('products', ProductController::class);

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Route untuk Keranjang Belanja (Cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/apply-code', [CartController::class, 'applyCode'])->name('cart.apply-code');
