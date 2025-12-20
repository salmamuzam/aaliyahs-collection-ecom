<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;


class ProductForm extends Component
{
    // Define properties based on input binding

    #[Validate('required', message: 'Product name is required!')]
    #[Validate('min:3', message: 'Product name must be minimum 3 characters long!')]
    #[Validate('max:150', message: 'Product name must not be more than 150 characters long!')]
    public $name;

    #[Validate('required', message: 'Product description is required!')]
    #[Validate('min:10', message: 'Product description must be minimum 10 characters long!')]
    public $description;
    public $category;
    public $price;

    // Dynamic validation

    #[Validate('required', message: 'Product image is required!')]
    #[Validate('image', message: 'Product image must be a valid image!')]
    #[Validate('mimes:jpg,jpeg,png,svg,webp', message: 'Product image accepts only jpg, jpeg, png, svg, and webp!')]
    #[Validate('max:2048', message: 'Product image must not be larger than 2MB!')]

    public $image;

    public function saveProduct(){
        // Trigger validation rule during form submit
        $this->validate();
    }
    public function render()
    {
        return view('livewire.product-form');
    }
}
