<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $categories = App\Models\Category::with('products')->get();
    return view('user.home', compact('categories'));
})->name('home');

Route::get('/product/detail/{id}', function ($id) {
    $product = Product::findOrFail($id);
    // Mengarah ke resources/views/user/show.blade.php
    return view('user.show', compact('product'));
})->name('product.detail');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Keranjang (Cart)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout & Payment
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/sukses', [CheckoutController::class, 'sukses'])->name('checkout.sukses');
    Route::put('/checkout/{order}/bukti-pembayaran', [CheckoutController::class, 'updatePaymentProof'])->name('checkout.updatePaymentProof');

    // History Pesanan untuk User
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('/category', CategoryController::class);
        Route::resource('/products', ProductController::class);

        Route::get('/admin/payments', [OrderController::class, 'adminIndex'])->name('admin.payments.index');
        Route::get('/admin/payments/{order}/show', [OrderController::class, 'showPayment'])->name('admin.payments.show');

        Route::post('/admin/payments/{id}/confirm', [OrderController::class, 'confirmPayment'])->name('admin.payments.confirm');
    });

});

require __DIR__ . '/auth.php';