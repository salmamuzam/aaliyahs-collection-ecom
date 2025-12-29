<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Success | Aaliyah Collection')]
class SuccessPage extends Component
{
    public function render()
    {
        // Latest order
        // Fetch the order using the address relationship
        // Get current logged in user_id
        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();
        return view('livewire.success-page', [
            'order' => $latest_order,
        ]);
    }
}


