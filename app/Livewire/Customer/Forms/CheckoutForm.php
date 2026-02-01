<?php

namespace App\Livewire\Customer\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CheckoutForm extends Form
{
    #[Validate('required')]
    public $first_name = '';

    #[Validate('required')]
    public $last_name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $phone = '';

    #[Validate('required')]
    public $street_address = '';

    #[Validate('required')]
    public $city = '';

    #[Validate('required')]
    public $province = '';

    #[Validate('required')]
    public $postal_code = '';

    #[Validate('required')]
    public $payment_method = 'cod';

    public function setUser($user)
    {
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name ?? '';
        $this->email = $user->email;
    }
}
