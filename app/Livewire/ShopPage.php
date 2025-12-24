<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShopPage extends Component
{
    use WithPagination;

    #[Url]

    // can contain more than one category
    public $selected_categories = [];

    #[Url]
    public $price_range = 50000;


    #[Title('Products | Aaliyah Collection')]
    public function render()
    {
        // every product contains product id
        // filter based on category_id
        $productQuery = Product::query();
        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);

        }
        // when value of price range changes
        if ($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        return view('livewire.shop-page', [
            'products' => $productQuery->paginate(6),
            'categories' => Category::all(),
        ]);
    }
}
