<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\controllerprofile;
use App\Http\Controllers\product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [controllerprofile::class, 'index'])->name('profile');

Route::get('/product', [product::class, 'index'])->name('product');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::resource('products', ProductController::class);
