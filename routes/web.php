<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product; // Pastikan Model Product di-import
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Mengambil data produk terbaru untuk ditampilkan di landing page
    $products = Product::latest()->get();

    // Mengarahkan ke file resources/views/user/home.blade.php
    return view('user.home', compact('products'));
})->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    // Route resource untuk mengelola produk dan kategori di sisi admin
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);

    // Route Profile bawaan Laravel Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';