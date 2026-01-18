<?php

namespace App\Livewire\Guest;

use App\Helpers\CartManagement;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Enums\Icon;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Lazy;
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

    public $favoriteIds = [];

    public function mount()
    {
        $favorites = \App\Helpers\FavoritesManagement::getFavoriteItemsFromCookie();
        $this->favoriteIds = array_column($favorites, 'product_id');
    }

    public function updatingPriceRange()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategories()
    {
        $this->resetPage();
    }

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

            // Remove from local array
            if (($key = array_search($product_id, $this->favoriteIds)) !== false) {
                unset($this->favoriteIds[$key]);
            }
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

            // Add to local array
            if (!in_array($product_id, $this->favoriteIds)) {
                $this->favoriteIds[] = $product_id;
            }
        }
    }

    public function isInFavorites($product_id)
    {
        return in_array($product_id, $this->favoriteIds);
    }

    #[Computed]
    public function categories()
    {
        return cache()->remember('shop_categories', 3600, fn() => Category::all());
    }

    #[Title('Products | Aaliyah Collection')]
    public function render()
    {
        $products = Product::query()
            ->when($this->selected_categories, fn($q) => $q->whereIn('category_id', $this->selected_categories))
            ->when($this->price_range, fn($q) => $q->whereBetween('price', [0, $this->price_range]))
            ->when($this->sort === 'latest', fn($q) => $q->latest())
            ->when($this->sort === 'price', fn($q) => $q->orderBy('price'))
            ->paginate(6);

        return view('livewire.guest.shop-page', [
            'products' => $products,
            'categories' => $this->categories,
        ]);
    }
    public function placeholder()
    {
        return view('livewire.placeholders.shop-skeleton');
    }
}
