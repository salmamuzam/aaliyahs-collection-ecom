<?php

namespace App\Livewire\Guest;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Computed;

#[Title('Cart | Aaliyah Collection')]

class CartPage extends Component
{



    public $cart_items = [];
    public $grand_total = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: CartManagement::calculateTotalCount($this->cart_items));
    }

    public function increaseQty($product_id)
    {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: CartManagement::calculateTotalCount($this->cart_items));
    }

    public function decreaseQty($product_id)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: CartManagement::calculateTotalCount($this->cart_items));
    }

    public function render()
    {
        return view('livewire.guest.cart-page');
    }
}
