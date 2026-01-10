<?php

namespace App\Livewire\Guest;

use App\Helpers\CartManagement;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]
class ProductDetailPage extends Component
{
    #[Title('Product Detail | Aaliyah Collection')]

    public $product;
    public $quantity = 1;
    public $isFavorite = false;
    public $currentImageIndex = 0;

    public function nextImage()
    {
        $count = count($this->product->images);
        $this->currentImageIndex = ($this->currentImageIndex + 1) % $count;
    }

    public function prevImage()
    {
        $count = count($this->product->images);
        $this->currentImageIndex = ($this->currentImageIndex - 1 + $count) % $count;
    }

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->isFavorite = collect(\App\Helpers\FavoritesManagement::getFavoriteItemsFromCookie())
            ->contains('product_id', $product->id);
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
        $total_count = CartManagement::addItemToCartWithQty($product_id, $this->quantity);
        $this->dispatch('update-cart-count', total_count: $total_count);

        LivewireAlert::title('Success')->text('Added to cart!')->success()->position('top-end')->timer(3000)->toast()->show();
    }

    public function addToFavorites($product_id)
    {
        if ($this->isFavorite) {
            $total_count = count(\App\Helpers\FavoritesManagement::removeFavoriteItem($product_id));
            LivewireAlert::title('Removed')->text('Removed from favorites!')->info()->position('top-end')->timer(3000)->toast()->show();
            $this->isFavorite = false;
        } else {
            $total_count = \App\Helpers\FavoritesManagement::addItemToFavorites($product_id);
            LivewireAlert::title('Success')->text('Added to favorites!')->success()->position('top-end')->timer(3000)->toast()->show();
            $this->isFavorite = true;
        }

        $this->dispatch('update-favorite-count', total_count: $total_count);
    }

    public function render()
    {
        return view('livewire.guest.product-detail-page');
    }

    public function placeholder()
    {
        return view('livewire.placeholders.product-detail-skeleton');
    }
}
