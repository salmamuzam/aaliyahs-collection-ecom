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
        $this->isView = request()->routeIs('categories.view');

        if ($category->exists) {
            $this->category = $category;
            $this->fill($category->only('name'));
        }
    }

    public function saveCategory()
    {
        $this->validate();

        $this->validate([
            'image' => ($this->category?->image ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,svg,webp|max:2048'
        ], [
            'image.required' => 'Category image is required!',
            'image.image' => 'Must be a valid image!',
            'image.mimes' => 'Accepted: jpg, jpeg, png, svg, webp!',
            'image.max' => 'Limit: 2MB!',
        ]);

        $imagePath = $this->image
            ? $this->image->storeAs('uploads/categories', time() . '.' . $this->image->extension(), 'public')
            : $this->category?->image;

        $data = ['name' => $this->name, 'image' => $imagePath];

        if ($this->category) {
            $status = $this->category->update($data);
            $message = $status ? 'Category updated successfully!' : 'Unable to update category!';
        } else {
            $status = Category::create($data);
            $message = $status ? 'Category created successfully!' : 'Unable to create category!';
        }

        session()->flash($status ? 'success' : 'error', $message);

        return $this->redirect(route('categories', absolute: false), navigate: true);
    }

    public function placeholder()
    {
        return view('livewire.placeholders.form-skeleton');
    }

    public function render()
    {
        return view('livewire.admin.category-form');
    }
}
