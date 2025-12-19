<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class CategoryForm extends Component
{
    use WithFileUploads;

    public $category = null;
    public $isView = false;

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

    // Capture the route model binding instead of id
    // Fetch the categories of the given id based on the model
    public function mount(Category $category)
    {
        // check whether the route is view
        // When the preview button is clicked, admin will be redirected to the category view page
        // this has been captured here, and set to true
        $this->isView = request()->routeIs('categories.view');
        // Check whether the category data exists
        if ($category->id) {
            $this->category = $category;
            // Assign the name to the public properties
            $this->name = $category->name;
        }
    }

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
            $imagePath = $this->image->storeAs('uploads', $imageName, 'public');
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
