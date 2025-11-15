<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// 1. Home page (public/user)
Route::get('/', function () {
    return view('user.home'); // Asumsikan ada view 'user.home' untuk user biasa/public
})->name('home');

// 2. Dashboard (admin)
// Rute ini memerlukan autentikasi, verifikasi, dan peran 'admin'
Route::get('/dashboard', function () {
    // Diasumsikan 'dashboard' adalah view admin utama (home.blade.php di modul 4)
    return view('home');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

// 3. Profile (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 4. Product & Category Management (Hanya Admin yang Bisa Akses)
// Gunakan route group dengan middleware 'auth' dan 'admin'
Route::middleware(['auth', 'admin'])->group(function () {
    // Resource Route untuk Products: products.index, products.create, dst.
    Route::resource('products', ProductController::class);

    // Resource Route untuk Category: category.index, category.create, dst.
    Route::resource('category', CategoryController::class);
});

require __DIR__ . '/auth.php';