<?php

namespace App\Livewire\Customer;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Checkout | Aaliyah Collection')]
class CheckoutPage extends Component
{
    use \App\Traits\HasHoneypot;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $street_address;
    public $city;
    public $province;
    public $postal_code;
    public $payment_method = 'cod';

    // API Integration Data
    public $districts = [];
    public $available_cities = [];

    public function mount()
    {
        // If there are no items in the cart, redirect to shop page
        // grab the cart items from the cookie
        $cart_items = CartManagement::getCartItemsFromCookie();
        // count cart items
        if (count($cart_items) == 0) {
            return redirect('/shop');
        }

        // Prefill user details
        $user = auth()->user();
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name ?? ''; // Allow null for Google users
        $this->email = $user->email;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
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
    }

    public function placeOrder()
    {
        $this->validateHoneypot();

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

        // Create Quote/Order within a transaction
        try {
            DB::beginTransaction();

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
            $order->save();

            // Create and save address professionally
            $order->address()->create([
                'user_id' => auth()->user()->id,
                'first_name' => (string) $this->first_name,
                'last_name' => (string) $this->last_name,
                'email' => (string) $this->email,
                'phone' => (string) $this->phone,
                'street_address' => (string) $this->street_address,
                'city' => (string) $this->city,
                'province' => (string) $this->province,
                'postal_code' => (string) $this->postal_code,
                'country' => 'Sri Lanka',
            ]);

            // Create order items for each product in cart
            foreach ($cart_items as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_amount' => $item['unit_amount'],
                    'total_amount' => $item['total_amount']
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Log error and show alert
            \Illuminate\Support\Facades\Log::error('Order Placement Failed: ' . $e->getMessage());
            $this->addError('base', 'Order creation failed. Please try again.');
            return;
        }

        // Clear cart items
        CartManagement::clearCartItems();
        $this->dispatch('update-cart-count', total_count: 0);

        // Send Mail (Queued via Job ideally, but safe here after commit)
        try {
            Mail::to(request()->user())->send(new OrderPlaced($order));
        } catch (\Exception $e) {
            // Mail failure shouldn't rollback order
            \Illuminate\Support\Facades\Log::error('Order Mail Failed: ' . $e->getMessage());
        }

        // Logic for Payment Redirection
        if ($this->payment_method === 'stripe') {
            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'customer_email' => $this->email,
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'lkr',
                                'product_data' => [
                                    'name' => 'Order #' . $order->id,
                                ],
                                'unit_amount' => (int) ($order->grand_total * 100), // Amount in cents
                            ],
                            'quantity' => 1,
                        ]
                    ],
                    'mode' => 'payment',
                    'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $order->id, // Passing order_id for easier update
                    'cancel_url' => route('payment.cancel'),
                ]);

                return redirect()->away($session->url);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error("Stripe Error: " . $e->getMessage());
                $this->addError('payment_method', 'Stripe Error: ' . $e->getMessage());
                return;
            }
        }

        // Redirect without page refresh
        return $this->redirect(route('success', ['order' => $order->id]), navigate: true);
    }

    public function render()
    {
        // fetch items from cookie
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.customer.checkout.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
