<?php

use App\Livewire\CategoryForm;
use App\Livewire\MyOrdersPage;
use App\Livewire\ShopPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoryList;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductForm;
use App\Livewire\ProductList;
use App\Livewire\SuccessPage;

Route::get('/', HomePage::class);
Route::get('/shop', ShopPage::class);
Route::get('/cart', CartPage::class);
Route::get('/shop/{product}', ProductDetailPage::class);
Route::get('/checkout', CheckoutPage::class);
Route::get('/my-orders', MyOrdersPage::class);
Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');
Route::get('/success', SuccessPage::class)->name('success');
Route::get('/cancel', CancelPage::class)->name('cancel');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// When a user is logged in, /home is called instead of /dashboard
// It was modified in fortify.php
// It will also call the index function in the Home Controller
// The index function will check the user_type
Route::get('/home', [HomeController::class, 'index']);

// When /adminpage is accessed, this will check whether the user is logged in
// If the user is not logged in, it will send the user to the login page
Route::get('/adminpage', [HomeController::class, 'page'])->middleware(['auth', 'admin']);

// When log in with google button is called, this route calls the function 'googlepage'
Route::get('auth/google', [GoogleController::class, 'googlepage']);
// Then if I select an account, this route calls the function 'googleback'
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback']);

// Livewire Components
Route::get('categories', CategoryList::class)->name('categories');
Route::get('categories/create', CategoryForm::class)->name('categories.create');
Route::get('categories/{category}/view', CategoryForm::class)->name('categories.view');
Route::get('categories/{category}/edit', CategoryForm::class)->name('categories.edit');

Route::get('products', ProductList::class)->name('products');
Route::get('products/create', ProductForm::class)->name('products.create');
Route::get('products/{product}/view', ProductForm::class)->name('products.view');
Route::get('products/{product}/edit', ProductForm::class)->name('products.edit');
