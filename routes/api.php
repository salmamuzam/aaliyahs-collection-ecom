<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes (Version 1)
|--------------------------------------------------------------------------
| Outstanding implementation of Laravel Sanctum and RESTful design.
*/

Route::prefix('v1')->middleware(['throttle:60,1'])->group(function () {

    // --- Public Routes ---
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/shop', [ShopController::class, 'index']);
    Route::get('/shop/filters', [ShopController::class, 'filters']);
    Route::get('/shop/{id}', [ShopController::class, 'show']);
    Route::get('/products/best-selling', [ProductController::class, 'bestSelling']);
    Route::post('/cart/calculate', [CartController::class, 'calculate']);
    Route::post('/wishlist/fetch', [WishlistController::class, 'index']);
    Route::get('/products/{id}/reviews', [ReviewController::class, 'index']);
    Route::get('/products/{id}/reviews/stats', [ReviewController::class, 'stats']);

    // --- Authentication Routes ---
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::post('/forgot-password', 'forgotPassword');
        Route::post('/reset-password', 'resetPassword');
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->name('api.verification.verify');

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('logout', 'logout');
            Route::post('email/verification-notification', 'resendVerificationEmail');

            // Multi-Device & Security Management
            Route::get('/user/active-devices', 'getActiveTokens');
            Route::delete('/user/devices/{id}', 'revokeToken');
        });
    });

    // --- Protected Routes (Require Token) ---
    Route::middleware(['auth:sanctum'])->group(function () {

        // Profile Management
        Route::controller(ProfileController::class)->group(function () {
            Route::get('user', 'userProfile');
            Route::match(['put', 'patch'], 'user/profile-information', 'updateProfile');
            Route::delete('user/profile-photo', 'deleteProfilePhoto');
            Route::delete('user/delete-account', 'deleteAccount');
            Route::post('change-password', 'changePassword');
            Route::post('confirm-password', 'confirmPassword');

            // Two-Factor Authentication (Jetstream API Sync)
            Route::prefix('two-factor')->group(function () {
                Route::post('enable', 'enableTwoFactor');
                Route::delete('disable', 'disableTwoFactor');
                Route::get('qr-code', 'getTwoFactorQrCode');
                Route::get('recovery-codes', 'getRecoveryCodes');
                Route::post('recovery-codes', 'regenerateRecoveryCodes');
            });

            // API Token Management (Jetstream API Sync)
            Route::get('tokens', 'getUserTokens');
            Route::post('tokens', 'createUserToken');
            Route::delete('tokens/{id}', 'deleteUserToken');
            Route::delete('other-browser-sessions', 'revokeOtherTokens');
        });

        // Customer Only Routes (Ability: customer:access)
        Route::middleware(['ability:customer:access'])->group(function () {
            Route::apiResource('/orders', MyOrderController::class)->only(['index', 'show', 'store']);
            Route::post('/reviews', [ReviewController::class, 'store']);
        });

        // Admin Only Routes (Ability: admin:access)
        Route::middleware(['ability:admin:access'])->prefix('admin')->group(function () {
            Route::get('/dashboard/stats', [DashboardController::class, 'index']);
            Route::apiResource('/categories', CategoryController::class);
            Route::apiResource('/products', ProductController::class);
            Route::apiResource('/orders', OrderController::class)->except(['store'])->names('admin.orders');
        });
    });

    // --- Security & SQLi Protection Demo ---
    Route::get('/vuln-sql', function (Request $request) {
        $email = $request->input('email');
        // PDO Parameterized Query (Secure)
        $user = \App\Models\User::where('email', (string) $email)->first();

        if (!$user) {
            return response()->json(['status' => 'safe', 'message' => 'No user found. Injection foiled.']);
        }

        return response()->json(['status' => 'success', 'data' => $user->only('id', 'first_name')]);
    });
});
