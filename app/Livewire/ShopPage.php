<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    #[Title('Products | Aaliyah Collection')]
    public function render()
    {
        $productQuery = Product::query();
        return view('livewire.shop-page', [
            'products' => $productQuery->paginate(6),
            'categories' =>Category::all(),
        ]);
    }
}
