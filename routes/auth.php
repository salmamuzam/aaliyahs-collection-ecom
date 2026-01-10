<?php

use App\Livewire\Customer\MyOrdersPage;
use App\Livewire\Customer\CheckoutPage;
use App\Livewire\Customer\MyOrderDetailPage;
use App\Livewire\Customer\FavoritesPage;
use App\Livewire\Guest\SuccessPage;
use App\Livewire\Guest\CancelPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Authentication Routes (Accessible only by logged-in users: Customers and Admins)
Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
    'customer'
])->group(function () {
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');

    Route::get('/success', SuccessPage::class)->name('auth.success');
    Route::get('/cancel', CancelPage::class)->name('auth.cancel');
});

// Redirect route for all authenticated users (Admins go to overview, Customers go to shop/home)
Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified'
])->get('/home', [HomeController::class, 'index'])->name('home.redirect');
