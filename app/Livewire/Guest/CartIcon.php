<?php

namespace App\Livewire\Guest;

use App\Helpers\CartManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public $total_count = 0;

    public function mount()
    {
        $this->total_count = CartManagement::calculateTotalCount(CartManagement::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count)
    {
        $this->total_count = $total_count;
    }

    public function render()
    {
        return view('livewire.guest.navbar.cart-icon');
    }
}
