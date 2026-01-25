<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', App\Livewire\Guest\HomePage::class)->name('home');
Route::get('/shop', App\Livewire\Guest\ShopPage::class)->name('shop');
Route::get('/categories', App\Livewire\Guest\CategoriesPage::class)->name('categories');
Route::get('/products/{product}', App\Livewire\Guest\ProductDetailPage::class)->name('product.detail');
Route::get('/cart', App\Livewire\Guest\CartPage::class)->name('cart');
Route::get('/checkout', App\Livewire\Guest\CheckoutPage::class)->name('checkout');
Route::get('/my-orders', App\Livewire\Guest\MyOrdersPage::class)->name('my-orders');
Route::get('/my-orders/{order}', App\Livewire\Guest\OrderDetailPage::class)->name('my-orders.show');
Route::get('/cancel', App\Livewire\Guest\CancelPage::class)->name('cancel');
Route::get('/success', App\Livewire\Guest\SuccessPage::class)->name('success');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');
});

Route::get('/debug-config', function () {
    return [
        'cloudinary_config' => config('cloudinary'),
        'filesystems' => config('filesystems.disks.cloudinary'),
        'env_url' => env('CLOUDINARY_URL'),
    ];
});

require __DIR__ . '/admin.php';
