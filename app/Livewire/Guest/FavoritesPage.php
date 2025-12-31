<?php

namespace App\Livewire\Guest;

use App\Helpers\FavoritesManagement;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Wishlist | Aaliyah Collection')]
class FavoritesPage extends Component
{
    public $favorite_items = [];

    public function mount()
    {
        $this->favorite_items = FavoritesManagement::getFavoriteItemsFromCookie();
    }

    public function removeItem($product_id)
    {
        $this->favorite_items = FavoritesManagement::removeFavoriteItem($product_id);
        $this->dispatch('update-favorite-count', total_count: count($this->favorite_items));
        LivewireAlert::title('Removed')
            ->text('Product removed from favorites!')
            ->info()
            ->position('top-end')
            ->timer(3000)
            ->toast()
            ->show();
    }

    public function addToCart($product_id)
    {
        $total_count = \App\Helpers\CartManagement::addItemToCartWithQty($product_id, 1);
        $this->dispatch('update-cart-count', total_count: $total_count);
        LivewireAlert::title('Success!')
            ->text('Product added to the cart!')
            ->success()
            ->position('top-end')
            ->timer(3000)
            ->toast()
            ->show();
    }

    public function render()
    {
        return view('livewire.guest.favorites-page');
    }
}
