<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\controllerprofile;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

Route::post('/cart/apply-code', [CartController::class, 'applyCode'])
    ->name('cart.apply-code');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [controllerprofile::class, 'index'])->name('profile');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/product', [ProductController::class, 'index'])->name('product.index');