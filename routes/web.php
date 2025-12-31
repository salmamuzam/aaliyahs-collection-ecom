<?php

// Guest/Public Components
use App\Livewire\Guest\ShopPage;
use App\Livewire\Guest\CartPage;
use App\Livewire\Guest\HomePage;
use App\Livewire\Guest\ProductDetailPage;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

// ============================================
// Public Routes (Accessible by everyone)
// ============================================
Route::get('/', HomePage::class)->name('home');
Route::get('/shop', ShopPage::class)->name('shop');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/shop/{product}', ProductDetailPage::class)->name('product.detail');
Route::get('/wishlist', \App\Livewire\Guest\FavoritesPage::class)->name('wishlist');

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
