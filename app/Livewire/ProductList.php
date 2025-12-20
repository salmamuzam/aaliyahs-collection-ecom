<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\withPagination;
use Livewire\WithoutUrlPagination;

class ProductList extends Component
{
    use withPagination, WithoutUrlPagination;

    public function render()
    {
        // Fetch the products
        // Show the last created product first
        $products = Product::orderBy('id', 'desc')->paginate(4);
        return view('livewire.product-list', compact('products'));
    }
}
