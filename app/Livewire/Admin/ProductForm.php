<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

class ProductForm extends Component
{
    use WithFileUploads;

    #[Title('Admin Dashboard | Manage Products')]

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
    public $images = [];
    public $existingImages = [];

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
            $this->existingImages = $product->images ?? [];
        }
    }

    public function removeExistingImage($index)
    {
        if (isset($this->existingImages[$index])) {
            unset($this->existingImages[$index]);
            $this->existingImages = array_values($this->existingImages);
        }
    }

    public function saveProduct()
    {
        // Trigger validation rule during form submit
        // Only for name, description, price, and category
        $this->validate();
        // Define rules
        $rules = [
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048'
        ];

        // Custom error messages
        $messages = [
            'images.*.image' => 'Each file must be a valid image!',
            'images.*.mimes' => 'Images accept only jpg, jpeg, png, svg, and webp!',
            'images.*.max' => 'Each image must not be larger than 2MB!',
        ];

        // Trigger image validation rules
        $this->validate($rules, $messages);

        // Check if at least one image exists (for new products or if all existing images were removed)
        if (!$this->product && empty($this->images)) {
            $this->addError('images', 'At least one image is required!');
            return;
        }

        // For existing products, check if there are any images left
        if ($this->product && empty($this->images) && empty($this->existingImages)) {
            $this->addError('images', 'At least one image is required!');
            return;
        }

        $imagePaths = $this->existingImages;

        // Upload new files
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                // Store product images in uploads/products folder
                $imagePath = $image->storeAs('uploads/products', $imageName, 'public');
                $imagePaths[] = $imagePath;
            }
        }

        // Update functionality
        // If product is in edit mode, update the product
        if ($this->product) {
            // Assign columns from mount to db column name
            $this->product->name = $this->name;
            $this->product->description = $this->description;
            $this->product->category_id = $this->category_id;
            $this->product->price = $this->price;
            $this->product->images = $imagePaths;

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
            // Ensure at least one image is uploaded for new products
            if (empty($imagePaths)) {
                session()->flash('error', 'At least one product image is required!');
                return;
            }

            // Insert the data into the table
            $product = Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'category_id' => $this->category_id,
                'price' => $this->price,
                // Store the file paths
                'images' => $imagePaths
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
        return $this->redirect(route('products', absolute: false), navigate: true);
    }
    public function render()
    {
        return view('livewire.admin.product-form');
    }
}
