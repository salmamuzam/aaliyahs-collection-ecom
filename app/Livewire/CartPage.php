<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Cart | Aaliyah Collection')]

class CartPage extends Component
{

    public $cart_items = [];

    public $grand_total;

    public function mount()
    {
        // fetch all cart items which are stored in the cookie
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
