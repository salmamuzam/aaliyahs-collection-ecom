<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Checkout | Aaliyah Collection')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $street_address;
    public $city;
    public $province;
    public $postal_code;
    public $payment_method = 'cod';

    public function mount()
    {
        // If there are no items in the cart, redirect to shop page
       // grab the cart items from the cookie
        $cart_items = CartManagement::getCartItemsFromCookie();
       // count cart items
        if (count($cart_items) == 0) {
            return redirect('/shop');
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
            'street_address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required'
        ]);

        // get the cart items from the cookie
        $cart_items = CartManagement::getCartItemsFromCookie();

        $order = new Order();
        // assign to current logged in user
        $order->user_id = auth()->user()->id;
        // calculate grand total from items which are available in cookie
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'lkr';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        //access logged in first name and last name
        $order->notes = 'Order placed by' . auth()->user()->first_name . ' ' . auth()->user()->last_name;
        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->email = $this->email;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->province = $this->province;
        $address->postal_code = $this->postal_code;
        $address->country = 'Sri Lanka';

        $order->save();

        // Create and save address
        $address->order_id = $order->id;
        $address->user_id = auth()->user()->id;
        $address->save();

        // Create order items for each product in cart
        foreach ($cart_items as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['total_amount']
            ]);
        }

        // Clear cart items
        CartManagement::clearCartItems();

        // Redirect without page refresh
        return $this->redirect(route('success'), navigate: true);
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
