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
        $products = Product::paginate(4);
        return view('livewire.product-list', compact('products'));
    }
}
