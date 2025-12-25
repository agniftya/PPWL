<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// 1. Route Landing Page (Modul 9)
Route::get('/', function () {
    $products = Product::latest()->get();
    return view('user.home', compact('products'));
})->name('home');

// 2. Route Khusus Admin (Modul 10)
Route::middleware(['auth', 'admin'])->group(function () {
    // Berdasarkan image_19f3c5.png, folder kamu 'admin' dan filenya 'dashboard.blade.php'
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});

// 3. Route Profile (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])
    > name('cart.update');
Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])
    > name('cart.remove');

require __DIR__ . '/auth.php';