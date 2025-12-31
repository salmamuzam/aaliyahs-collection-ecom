<?php

namespace App\Livewire\Guest;

use App\Helpers\CartManagement;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

use Livewire\Attributes\Title;
use Livewire\Component;

class ProductDetailPage extends Component
{
    #[Title('Product Detail | Aaliyah Collection')]

    public $id;
    public $quantity = 1;
    public $isFavorite = false;

    public function mount($product)
    {
        $this->id = $product;
        $this->checkIsFavorite();
    }

    public function checkIsFavorite()
    {
        $favorite_items = \App\Helpers\FavoritesManagement::getFavoriteItemsFromCookie();
        $this->isFavorite = false;
        foreach ($favorite_items as $item) {
            if ($item['product_id'] == $this->id) {
                $this->isFavorite = true;
                break;
            }
        }
    }

    public function increaseQty()
    {
        $this->quantity++;
    }

    public function decreaseQty()
    {

        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    // add product to cart method

    public function addToCart($product_id)
    {
        // return total number of item count
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);
        $this->dispatch('update-cart-count', total_count: $total_count);
        LivewireAlert::title('Success!')
            ->text('Product added to the cart!')
            ->success()
            ->position('top-end')
            ->timer(3000)
            ->toast()
            ->show();
    }

    public function addToFavorites($product_id)
    {
        if ($this->isFavorite) {
            // Remove from favorites logic if needed, but for now we just toggle add
            // Usually we'd want remove logic here if it's a toggle
            $total_count = count(\App\Helpers\FavoritesManagement::removeFavoriteItem($product_id));
            LivewireAlert::title('Removed')
                ->text('Product removed from favorites!')
                ->info()
                ->position('top-end')
                ->timer(3000)
                ->toast()
                ->show();
            $this->isFavorite = false;
        } else {
            $total_count = \App\Helpers\FavoritesManagement::addItemToFavorites($product_id);
            LivewireAlert::title('Success!')
                ->text('Product added to favorites!')
                ->success()
                ->position('top-end')
                ->timer(3000)
                ->toast()
                ->show();
            $this->isFavorite = true;
        }

        $this->dispatch('update-favorite-count', total_count: $total_count);
    }


    public function render()
    {
        return view(
            'livewire.guest.product-detail-page',
            [
                'product' => Product::where('id', $this->id)->firstOrFail()
            ]
        );
    }
}
