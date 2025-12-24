<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Enums\Icon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ShopPage extends Component
{

    use WithPagination;

    #[Url]

    // can contain more than one category
    public $selected_categories = [];

    #[Url]
    public $price_range = 50000;

    #[Url]
    public $sort = 'latest';

    // add product to cart method

    public function addToCart($product_id)
    {
        // return total number of item count
        $total_count = CartManagement::addItemToCart($product_id);
        // $this->dispatch('update-cart-count',  total_count: $total_count)->to(Navbar::class);
        LivewireAlert::title('Success!')
            ->text('Product added to the cart!')
            ->success()
            ->position('top-end')
            ->timer(3000)
            ->toast()
            ->show();
    }

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

        if ($this->sort == 'latest') {
            $productQuery->latest();
        }

        // sorts the price in ascending order

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        return view('livewire.shop-page', [
            'products' => $productQuery->paginate(6),
            'categories' => Category::all(),
        ]);
    }
}
