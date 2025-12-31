<?php

namespace App\Livewire\Guest;

use App\Helpers\CartManagement;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Enums\Icon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
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

    #[On('update-favorite-count')]
    public function refreshComponent()
    {
        // This will trigger a re-render to update heart icons
    }

    // add product to cart method

    public function addToCart($product_id)
    {
        // return total number of item count
        $total_count = CartManagement::addItemToCart($product_id);
        $this->dispatch('update-cart-count', total_count: $total_count);
        LivewireAlert::title('Success!')
            ->text('Product added to the cart!')
            ->success()
            ->position('top-end')
            ->timer(3000)
            ->toast()
            ->show();
    }

    public function toggleFavorite($product_id)
    {
        $favorites = \App\Helpers\FavoritesManagement::getFavoriteItemsFromCookie();
        $isFavorited = false;

        foreach ($favorites as $item) {
            if ($item['product_id'] == $product_id) {
                $isFavorited = true;
                break;
            }
        }

        if ($isFavorited) {
            $favorites = \App\Helpers\FavoritesManagement::removeFavoriteItem($product_id);
            $total_count = count($favorites);
            $this->dispatch('update-favorite-count', total_count: $total_count);
            LivewireAlert::title('Removed!')
                ->text('Product removed from favorites!')
                ->warning()
                ->position('top-end')
                ->timer(3000)
                ->toast()
                ->show();
        } else {
            $total_count = \App\Helpers\FavoritesManagement::addItemToFavorites($product_id);
            $this->dispatch('update-favorite-count', total_count: $total_count);
            LivewireAlert::title('Success!')
                ->text('Product added to favorites!')
                ->success()
                ->position('top-end')
                ->timer(3000)
                ->toast()
                ->show();
        }
    }

    public function isInFavorites($product_id)
    {
        $favorites = \App\Helpers\FavoritesManagement::getFavoriteItemsFromCookie();
        foreach ($favorites as $item) {
            if ($item['product_id'] == $product_id) {
                return true;
            }
        }
        return false;
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

        return view('livewire.guest.shop-page', [
            'products' => $productQuery->paginate(6),
            'categories' => Category::all(),
        ]);
    }
}
