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




// ============================================
// Include Admin Routes
// ============================================
// ============================================
// Debug Route
// ============================================
Route::get('/test-mail-debug', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('This is a test email checking SMTP configuration.', function ($message) {
            $message->to('aaliyahscollection@gmail.com') // Sending to the admin/support email or current user if possible
                ->subject('SMTP Debug Test');
        });
        return 'Email sent successfully! If you do not receive it, check your SPAM folder or SMTP Provider logs.';
    } catch (\Exception $e) {
        return 'Error sending email: ' . $e->getMessage();
    }
});

require __DIR__ . '/admin.php';