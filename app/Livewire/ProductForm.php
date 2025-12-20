<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    // Define properties based on input binding

    #[Validate('required', message: 'Product name is required!')]
    #[Validate('min:3', message: 'Product name must be minimum 3 characters long!')]
    #[Validate('max:50', message: 'Product name must not be more than 50 characters long!')]
    public $name;

    #[Validate('required', message: 'Product description is required!')]
    #[Validate('min:10', message: 'Product description must be minimum 10 characters long!')]
    public $description;
    public $categories;

    #[Validate('required', message: 'Product category is required!')]
    public $category_id;

    #[Validate('required', message: 'Product price is required!')]
    #[Validate('numeric', message: 'Product price must be a number!')]
    #[Validate('min:1000', message: 'Product price must not be less than 1000!')]
    #[Validate('max:100000', message: 'Product price must not be more than 100,000!')]

    public $price;

    // Dynamic validation

    #[Validate('required', message: 'Product image is required!')]
    #[Validate('image', message: 'Product image must be a valid image!')]
    #[Validate('mimes:jpg,jpeg,png,svg,webp', message: 'Product image accepts only jpg, jpeg, png, svg, and webp!')]
    #[Validate('max:2048', message: 'Product image must not be larger than 2MB!')]

    public $image;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function saveProduct()
    {
        // Trigger validation rule during form submit
        $this->validate();

        $imagePath = null;

        // Upload the file
        // If image is selected capture the extension of the image
        if ($this->image) {
            $imageName = time() . '.' . $this->image->extension();
            // Store the image with the timestamp name
            $imagePath = $this->image->storeAs('uploads', $imageName, 'public');
        }

        // Insert the data into the table

        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => $this->price,
            // Store the file path
            'image' => $imagePath
        ]);

        // If product is created
        if ($product) {
            session()->flash('success', 'Product has been created successfully!');
        }
        // However, if product is not created
        else {
            session()->flash('error', 'Unable to create product, please try again!');
        }

        // after product is created, redirect to the product listing page
        // no page refresh
        return $this->redirect('/products', navigate: true);
    }
    public function render()
    {
        return view('livewire.product-form');
    }
}
