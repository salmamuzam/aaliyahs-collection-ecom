<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Guest\ShopPage;
use App\Livewire\Guest\CartPage;
use App\Livewire\Guest\HomePage;
use App\Livewire\Guest\ProductDetailPage;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaymentController;

// ============================================
// Public Routes (Accessible by everyone)
// ============================================
Route::get('/', HomePage::class)->name('home');
Route::get('/shop', ShopPage::class)->name('shop');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/shop/{product}', ProductDetailPage::class)->name('product.detail');
Route::get('/wishlist', \App\Livewire\Guest\FavoritesPage::class)->name('wishlist');

// ============================================
// Payment Gateway Routes (PayHere)
// ============================================
// PayHere Redirect & Callbacks
Route::get('/payment/payhere/{order}', [PaymentController::class, 'payhereCheckout'])->name('payhere.checkout');
Route::any('/payment/return', [PaymentController::class, 'return'])->name('payment.return');
Route::any('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::get('/payment/success/{order?}', [PaymentController::class, 'success'])->name('success');

// ============================================
// Google Authentication
// ============================================
Route::get('auth/google', [GoogleController::class, 'googlepage']);
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);

// ============================================
// Include Authentication Routes
// ============================================
require __DIR__ . '/auth.php';

// Custom Registration Route (Overrides Fortify)
Route::post('/register', [\App\Http\Controllers\RegisteredUserController::class, 'store'])
    ->middleware(['guest:' . config('fortify.guard')])
    ->name('register');



// ============================================
// Include Admin Routes
// ============================================
require __DIR__ . '/admin.php';