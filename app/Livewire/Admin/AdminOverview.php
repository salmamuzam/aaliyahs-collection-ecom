<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class AdminOverview extends Component
{
    public function placeholder()
    {
        return view('livewire.placeholders.admin-overview-skeleton');
    }

    public function render()
    {
        return view('livewire.admin.admin-overview', [
            'totalOrders' => Order::count('*'),
            'totalProducts' => Product::count('*'),
            'totalCategories' => Category::count('*'),
            'totalCustomers' => User::where('user_type', 'customer')->count(),
            'recentOrders' => Order::with('user')->withoutGlobalScopes()->latest()->take(4)->get(),
        ]);
    }
}
