<?php

namespace App\Livewire\Guest;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Helpers\CartManagement;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class HomePage extends Component
{
    // Custom title
    #[Title('Home | Aaliyah Collection')]

    public $favoriteIds = [];

    public function mount()
    {
        $favorites = \App\Helpers\FavoritesManagement::getFavoriteItemsFromCookie();
        $this->favoriteIds = array_column($favorites, 'product_id');
    }

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCart($product_id);
        $this->dispatch('update-cart-count', total_count: $total_count);
        LivewireAlert::title('Success!')->text('Product added to the cart!')->success()->position('top-end')->timer(3000)->toast()->show();
    }

    public function toggleFavorite($product_id)
    {
        // helper logic
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
            LivewireAlert::title('Removed!')->text('Product removed from favorites!')->warning()->position('top-end')->timer(3000)->toast()->show();

            // Remove from local array
            if (($key = array_search($product_id, $this->favoriteIds)) !== false) {
                unset($this->favoriteIds[$key]);
            }
        } else {
            $total_count = \App\Helpers\FavoritesManagement::addItemToFavorites($product_id);
            $this->dispatch('update-favorite-count', total_count: $total_count);
            LivewireAlert::title('Success!')->text('Product added to favorites!')->success()->position('top-end')->timer(3000)->toast()->show();

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
    public function placeholder()
    {
        return view('livewire.guest.home.skeleton');
    }

    public function getCategoriesProperty()
    {
        return \Illuminate\Support\Facades\Cache::remember('home_categories', 3600, function () {
            return \App\Models\Category::all();
        });
    }

    public function getLatestProductsProperty()
    {
        return \Illuminate\Support\Facades\Cache::remember('home_latest_products', 600, function () {
            return \App\Models\Product::latest('created_at')->take(4)->get();
        });
    }

    public function getBestSellersProperty()
    {
        return \Illuminate\Support\Facades\Cache::remember('home_best_sellers', 3600, function () {
            return \App\Models\Product::withCount('orderItems')
                ->orderBy('order_items_count', 'desc')
                ->take(4)
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.guest.home.home-page');
    }
}
