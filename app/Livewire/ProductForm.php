<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    #[Rule('required|min:3|max:50')]
    public $name;

    #[Rule('required|min:5|max:255')]
    public $description;

    #[Rule('required')]
    public $price;

    #[Rule('required')]
    #[Rule(['images.*' => 'image|max:2048'])]
    public $images;

    public function createProduct()
    {
        $this->validate();
        if (is_array($this->images)) {
            foreach ($this->images as $image) {
                $image->store('uploads', 'public');
            }
        }
        session()->flash('success', 'A new product has been added successfully!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
