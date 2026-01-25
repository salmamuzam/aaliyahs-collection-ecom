<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Checkout - Aaliyah Collection')]
class CheckoutPage extends Component
{
    public function render()
    {
        return view('livewire.guest.checkout-page');
    }
}
