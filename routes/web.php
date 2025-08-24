<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\controllerprofile;
use App\Http\Controllers\product;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [controllerprofile::class, 'index'])->name('profile');

Route::get('/product', [product::class, 'index'])->name('product');
