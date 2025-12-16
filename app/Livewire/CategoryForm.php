<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryForm extends Component
{
    use WithFileUploads;

    #[Rule('required|min:3|max:50')]
    public $name;

    #[Rule('nullable|sometimes|image|max:1024')]
    public $image;

    public $category;


    public function createCategory()
    {
        // Validate
        $validated = $this->validateOnly('name');
        // Check whether the file exists
        if ($this->image) {
            // Handle the upload
            // Save the file
            $validated['image'] = $this->image->store('uploads', 'public');
        }
        // Create
        Category::create($validated);
        // Clear the input
        $this->reset('name', 'image');
        // Send the flash message
        session()->flash('success', 'A new category has been created successfully!');
    }



    public function render()
    {
        return view('livewire.category-form');
    }
}
