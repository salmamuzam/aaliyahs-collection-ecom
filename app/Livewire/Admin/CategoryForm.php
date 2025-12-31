<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

class CategoryForm extends Component
{
    use WithFileUploads;

    #[Title('Admin Dashboard | Manage Categories')]

    public $category = null;
    public $isView = false;

    // Define properties based on data input binding
    // Name Field Validation with customized message
    #[Validate('required', message: 'Category name is required!')]
    #[Validate('min:3', message: 'Category name must be minimum 3 characters long!')]
    #[Validate('max:150', message: 'Category name must not be more than 150 characters long!')]
    public $name;


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

        // Execute validation rules for name
        $this->validate();

        // Dynamic validation based on create and update functionality
        // Define rules
        $rules = [
            // Check whether we have category and image, if there is an image in edit mode it will be optional. However, if category does not have image, it will check the required validation
            'image' => $this->category && $this->category->image ? 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048' : 'required|image|mimes:jpg,jpeg,png,svg,webp|max:2048'
        ];

        // Customized error messages

        $messages = [
            'image.required' => 'Category image is required!',
            'image.image' => 'Category image must be a valid image!',
            'image.mimes' => 'Category image accepts only jpg, jpeg, png, svg, and webp!',
            'image.max' => 'Category image must not be larger than 2MB!',
        ];
        // Trigger validation rules for image only
        $this->validate($rules, $messages);

        $imagePath = null;
        // If image is selected, capture the extension

        if ($this->image) {
            // Time stamp
            $imageName = time() . '.' . $this->image->extension();
            // Store the image with the timestamp name in categories folder
            $imagePath = $this->image->storeAs('uploads/categories', $imageName, 'public');
        }

        // Update functionality
        // If category is in edit mode, update the category
        // Saves column data into the category table
        if ($this->category) {
            // Assign form inputs
            $this->category->name = $this->name;

            if ($imagePath) {
                $this->category->image = $imagePath;
            }

            $updateCategory = $this->category->save();

            // If category is created, display success message
            if ($updateCategory) {
                session()->flash('success', 'Category has been updated successfully!');
            }
            // However if category is not created, display an error message
            else {
                session()->flash('error', 'Unable to update category, please try again!');
            }

        } else {
            // Create functionality
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

        }

        // after the category is created,
        // redirect to the category list page
        // no page refresh
        return $this->redirect(route('categories', absolute: false), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.category-form');
    }
}
