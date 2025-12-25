<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// 1. Route Landing Page (Modul 9)
Route::get('/', function () {
    $products = Product::latest()->get();
    return view('user.home', compact('products'));
})->name('home');

// 2. Route Detail Produk
Route::get('/product/{id}', function ($id) {
    $product = Product::findOrFail($id);
    return view('user.show', compact('product'));
})->name('product.show');

// 3. Route Khusus Admin (Modul 10)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});

// 4. Route Khusus User Login (Keranjang, Checkout, Profile) - Modul 11
Route::middleware('auth')->group(function () {

    // Rute Keranjang (Cart)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Rute Checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');

    // Route Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';