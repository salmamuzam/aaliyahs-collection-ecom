<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\WishlistController;
use App\Http\Controllers\Api\MyOrderController;
use App\Http\Controllers\Api\ProfileController;

// Auth Routes

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/reset-password', 'resetPassword');

    // Email Verification Route
    Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->name('api.verification.verify');

    // Authenticated Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('logout', 'logout');
        Route::post('email/verification-notification', 'resendVerificationEmail');
    });
});

// Authenticated User Profile & Management (ProfileController)
Route::middleware('auth:sanctum')->controller(ProfileController::class)->group(function () {
    // Profile & Account
    Route::get('user', 'userProfile');
    Route::match(['put', 'patch'], 'user/profile-information', 'updateProfile');
    Route::delete('user/profile-photo', 'deleteProfilePhoto');
    Route::delete('user', 'deleteAccount');

    // Password
    Route::post('change-password', 'changePassword');
    Route::post('user/confirm-password', 'confirmPassword');

    // Two-Factor Authentication
    Route::post('user/two-factor-authentication', 'enableTwoFactor');
    Route::delete('user/two-factor-authentication', 'disableTwoFactor');
    Route::get('user/two-factor-qr-code', 'getTwoFactorQrCode');
    Route::get('user/two-factor-recovery-codes', 'getRecoveryCodes');
    Route::post('user/two-factor-recovery-codes', 'regenerateRecoveryCodes');

    // Sessions & Tokens
    Route::post('user/other-browser-sessions', 'revokeOtherTokens');
    Route::get('user/api-tokens', 'getUserTokens');
    Route::post('user/api-tokens', 'createUserToken');
    Route::delete('user/api-tokens/{tokenId}', 'deleteUserToken');
});

// ==========================
// Public Guest Routes
// ==========================
Route::get('/home', [HomeController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index']); // List
Route::get('/shop/{id}', [ShopController::class, 'show']); // Detail
// Extension: Related Products Endpoint
Route::get('/shop/{product}/related', [ProductController::class, 'related']);
Route::post('/cart/calculate', [CartController::class, 'calculate']); // Cart Logic
Route::post('/wishlist/fetch', [WishlistController::class, 'index']); // Wishlist Logic


// ==========================
// Protected User Routes
// ==========================
Route::middleware('auth:sanctum')->group(function () {
    // User's My Orders (List, Show, Place Order)
    Route::apiResource('/orders', MyOrderController::class)->only(['index', 'show', 'store']);

});

// ==========================
// Admin Routes
// ==========================
Route::middleware(['auth:sanctum', 'can:admin'])->prefix('admin')->group(function () {

    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/products', ProductController::class);

    // Admin Order Management
    Route::apiResource('/orders', OrderController::class)
        ->except(['store'])
        ->names('admin.orders');
});
