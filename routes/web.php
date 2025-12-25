<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// 1. Route untuk SEMUA ORANG (Admin, User, atau yang belum login)
Route::get('/', function () {
    $products = Product::latest()->get(); // Menggunakan model yang sudah di-import
    return view('user.home', compact('products'));
})->name('home');

// 2. Route KHUSUS ADMIN (Wajib login DAN punya role admin)
Route::middleware(['auth', 'admin'])->group(function () {

    // Halaman Dashboard Utama Admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Pengelolaan data produk dan kategori (Hanya Admin)
    Route::resource('products', ProductController::class);
    Route::resource('category', CategoryController::class);
});

// 3. Route untuk SEMUA YANG SUDAH LOGIN (Admin & User)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';