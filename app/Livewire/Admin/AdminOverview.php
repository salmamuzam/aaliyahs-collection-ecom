<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AdminOverview extends Component
{
    public function render()
    {
        return view('livewire.admin.admin-overview', [
            'totalOrders' => Order::count(),
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'recentOrders' => Order::with('user')->latest()->take(4)->get(),
        ]);
    }
}
