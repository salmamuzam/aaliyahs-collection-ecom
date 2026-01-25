<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Guest\ShopPage;
use App\Livewire\Guest\CartPage;
use App\Livewire\Guest\HomePage;
use App\Livewire\Guest\ProductDetailPage;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;

// ============================================
// Secured Shared Routes (Invoices/Profile etc)
// ============================================
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/orders/{order}/invoice', [InvoiceController::class, 'download'])->name('order.invoice');
});

// ============================================
// Public Routes (Accessible by everyone)
// ============================================
Route::get('/', HomePage::class)->name('home');
Route::get('/shop', ShopPage::class)->name('shop');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/shop/{product}', ProductDetailPage::class)->name('product.detail');
Route::get('/wishlist', \App\Livewire\Guest\FavoritesPage::class)->name('wishlist');

// New Guest Pages (Livewire)
Route::get('/categories', \App\Livewire\Guest\CategoriesPage::class)->name('categories');

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
// Dashboard Redirect Logic (Admin vs Customer)
// ============================================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->user_type === 'admin') {
            return redirect()->route('admin.overview');
        }
        return redirect()->route('home');
    })->name('dashboard');
});

// ============================================
// Include Authentication Routes
// ============================================
require __DIR__ . '/auth.php';

// ============================================
// Include Admin Routes
// ============================================
require __DIR__ . '/admin.php';

// ============================================
// Debug Route (SMTP)
// ============================================
Route::get('/test-mail-debug', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('This is a test email checking SMTP configuration.', function ($message) {
            $message->to('aaliyahscollection@gmail.com')
                ->subject('SMTP Debug Test');
        });
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});