<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// profile (tidak membutuhkan login) — memberikan user dummy bila belum login
Route::get('/profile', function () {
    $authUser = Auth::user();

    $user = $authUser ?? (object)[
        'name' => 'Guest User',
        'email' => 'guest@example.com',
        'avatar' => 'https://via.placeholder.com/150',
        'reward_points' => 0,
    ];

    $statistics = (object)[
        'total_waste' => 0,
        'completed_transactions' => 0,
        'total_contribution' => 0,
    ];

    $purchases = collect();

    return view('profile', compact('user', 'statistics', 'purchases'));
})->name('profile');
