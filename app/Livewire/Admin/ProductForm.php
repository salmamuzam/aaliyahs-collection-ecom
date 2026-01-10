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
        $this->isView = request()->routeIs('products.view');

        if ($product->exists) {
            $this->product = $product;
            $this->fill($product->only('name', 'description', 'category_id', 'price'));
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
        $this->validate();

        $this->validate([
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048'
        ], [
            'images.*.image' => 'Each file must be a valid image!',
            'images.*.mimes' => 'Images must be jpg, jpeg, png, svg, or webp!',
            'images.*.max' => 'Each image must not exceed 2MB!',
        ]);

        if (empty($this->images) && empty($this->existingImages)) {
            return $this->addError('images', 'At least one image is required!');
        }

        $imagePaths = $this->existingImages;

        foreach ($this->images as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $imagePaths[] = $image->storeAs('uploads/products', $imageName, 'public');
        }

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'images' => $imagePaths
        ];

        if ($this->product) {
            $status = $this->product->update($data);
            $message = $status ? 'Product updated successfully!' : 'Unable to update product!';
        } else {
            $status = Product::create($data);
            $message = $status ? 'Product created successfully!' : 'Unable to create product!';
        }

        session()->flash($status ? 'success' : 'error', $message);

        return $this->redirect(route('products', absolute: false), navigate: true);
    }
    public function placeholder()
    {
        return view('livewire.placeholders.form-skeleton');
    }

    public function render()
    {
        return view('livewire.admin.product-form');
    }
}
