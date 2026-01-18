<?php

use App\Livewire\Admin\CategoryForm;
use App\Livewire\Admin\CategoryList;
use App\Livewire\Admin\ProductForm;
use App\Livewire\Admin\ProductList;
use App\Livewire\Admin\AdminOverview;
use App\Livewire\Admin\OrderDetail;
use App\Livewire\Admin\OrderManagementComponent;
use App\Livewire\Admin\AnalyticsComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Admin ONLY Routes
Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/admin/overview', AdminOverview::class)->name('admin.overview');
    Route::get('/admin/analytics', AnalyticsComponent::class)->name('admin.analytics');

    // Category Management
    Route::get('admin/categories', CategoryList::class)->name('categories');
    Route::get('admin/categories/create', CategoryForm::class)->name('categories.create');
    Route::get('admin/categories/{category}/view', CategoryForm::class)->name('categories.view');
    Route::get('admin/categories/{category}/edit', CategoryForm::class)->name('categories.edit');

    // Product Management
    Route::get('admin/products', ProductList::class)->name('products');
    Route::get('admin/products/create', ProductForm::class)->name('products.create');
    Route::get('admin/products/{product}/view', ProductForm::class)->name('products.view');
    Route::get('admin/products/{product}/edit', ProductForm::class)->name('products.edit');

    // Order Management
    Route::get('admin/orders', OrderManagementComponent::class)->name('admin.orders');
    Route::get('admin/orders/{order}/view', OrderDetail::class)->name('orders.view');
});
