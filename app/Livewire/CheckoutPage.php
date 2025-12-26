<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Checkout | Aaliyah Collection')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $city;
    public $state;
    public $zip;
    public $payment_method = 'cod';

    public function mount()
    {
        $user = auth()->user();
        if ($user) {
            $this->first_name = $user->name; // Assuming name is full name, might need splitting or just put in first_name
            // If the user model has separate first/last names, use them. Standard Laravel User has 'name'. 
            // I'll try to split logic or just assign to first_name for now if simple. 
            // Let's check if User has first_name. Usually it's just 'name'.
            // I will split by space.
            $parts = explode(' ', $user->name);
            $this->first_name = $parts[0] ?? '';
            $this->last_name = $parts[1] ?? '';

            $this->email = $user->email;
        }
    }

    public function placeOrder()
    {
        $this->validate([
            // Validated input fields
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'payment_method' => 'required'
        ]);
    }

    public function render()
    {
        // fetch items from cookie
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
