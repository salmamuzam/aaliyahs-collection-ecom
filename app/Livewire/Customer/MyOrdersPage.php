<?php

namespace App\Livewire\Customer;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('My Orders | Aaliyah Collection')]

class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        // Only fetch orders that belong to the currently authenticated user
        $my_orders = Order::with(['user', 'items', 'address'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(4);

        return view('livewire.customer.my-orders-page', [
            'orders' => $my_orders,
        ]);
    }
}
