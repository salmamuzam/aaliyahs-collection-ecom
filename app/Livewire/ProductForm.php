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

    public $product = null;

    public $isView = false;

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

    public $image;

    public function mount(Product $product)
    {
        $this->categories = Category::all();
        // Check whether the route is products.view
        $this->isView = request()->routeIs('products.view');
        // Check whether we have the product data belonging to the id
        if ($product->id) {
            $this->product = $product;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->category_id = $product->category_id;
            $this->price = $product->price;
        }
    }

    public function saveProduct()
    {
        // Trigger validation rule during form submit
        // Only for name, description, price, and category
        $this->validate();
        // Define rules
        $rules = [
            'image' => $this->product && $this->product->image ? 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048' : 'required|image|mimes:jpg,jpeg,png,svg,webp|max:2048'
        ];

        // Custom error messages

        $messages = [
            'image.required' => 'Product image is required!',
            'image.image' => 'Product image must be a valid image!',
            'image.mimes' => 'Product image accepts only jpg, jpeg, png, svg, and webp!',
            'image.max' => 'Product image must not be larger than 2MB!',
        ];

        // Trigger image validation rules
        $this->validate($rules, $messages);


        $imagePath = null;

        // Upload the file
        // If image is selected capture the extension of the image
        if ($this->image) {
            $imageName = time() . '.' . $this->image->extension();
            // Store the image with the timestamp name
            $imagePath = $this->image->storeAs('uploads', $imageName, 'public');
        }

        // Update functionality
        // If product is in edit mode, update the product
        if ($this->product) {
            // Assign columns from mount to db column name
            $this->product->name = $this->name;
            $this->product->description = $this->description;
            $this->product->category_id = $this->category_id;
            $this->product->price = $this->price;

            // If we have the image path,
            if ($imagePath) {
                $this->product->image = $imagePath;
            }
            // Save column data in product table

            $updateProduct = $this->product->save();

            // If product is updated
            if ($updateProduct) {
                session()->flash('success', 'Product has been updated successfully!');
            }
            // However, if product is not updated
            else {
                session()->flash('error', 'Unable to update product, please try again!');
            }
        }

        // Create functionality
        else {
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
