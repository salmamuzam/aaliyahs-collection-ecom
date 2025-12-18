<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class CategoryForm extends Component
{
    use WithFileUploads;

    // Define properties based on data input binding
    // Name Field Validation with customized message
    #[Validate('required', message: 'Category name is required!')]
    #[Validate('min:3', message: 'Category name must be minimum 3 characters long!')]
    #[Validate('max:150', message: 'Category name must not be more than 150 characters long!')]
    public $name;

    // Dynamic Image Validation
    #[Validate('required', message: 'Category image is required!')]
    #[Validate('image', message: 'Category image must be a valid image!')]
    #[Validate('mimes:jpg,jpeg,png,svg,webp', message: 'Category image accepts only jpg, jpeg, png, svg, and webp!')]
    #[Validate('max:2048', message: 'Category image must not be larger than 2MB!')]
    public $image;

    // Form submission
    public function saveCategory()
    {
        // Execute validation rules
        $this->validate();

        $imagePath = null;

        // If image is selected, capture the extension

        if ($this->image) {
            // Time stamp
            $imageName = time() . '.' . $this->image->extension();
            // Store the image with the timestamp name
            $imagePath = $this->image->storeAs('public/uploads', $imageName);
        }

        // Insert the data into the category table
        $category = Category::create([
            // Array of data
            'name' => $this->name,
            // Store the image path
            'image' => $imagePath
        ]);

        // If category is created, display success message
        if ($category) {
            session()->flash('success', 'Category has been created successfully!');
        }
        // However if category is not created, display an error message
        else {
            session()->flash('error', 'Unable to create category, please try again!');
        }

        // after the category is created,
        // redirect to the category list page
        // no page refresh
        return $this->redirect('/categories', navigate: true);
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
