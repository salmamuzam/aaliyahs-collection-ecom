<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class AdminOverview extends Component
{

    public $totalOrders;
    public $totalProducts;
    public $totalCategories;
    public $recentOrders;

    public function mount()
    {
        $this->loadOverviewData();
    }

    public function loadOverviewData()
    {
        $this->totalOrders = Order::count();
        $this->totalProducts = Product::count();
        $this->totalCategories = Category::count();
        $this->recentOrders = Order::with('user')
            ->latest()
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.admin-overview');
    }
}
