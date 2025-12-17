<?php

namespace App\Livewire;

use App\Models\Category;
use Exception;
use Livewire\Component;

class CategoryList extends Component
{
    public $EditingCategoryID;
    public $EditingCategoryName;
    public $EditingCategoryImage;

    public $search = '';

    public function editCategory($categoryID)
    {
        $this->EditingCategoryID = $categoryID;
        $this->EditingCategoryName = Category::find($categoryID)->name;
        $this->EditingCategoryImage = Category::find($categoryID)->image;
    }

    public function deleteCategory($categoryID)
    {
        try {
            Category::findOrFail($categoryID)->delete();
            session()->flash('success', 'The category has been deleted successfully!');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to delete the category!');
            return;
        }

    }

    public function render()
    {
        if ($this->search) {
            return view('livewire.category-list', [
                'categories' => Category::where('name', 'LIKE', "%{$this->search}%")->get(),
            ]);
        }
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('livewire.category-list', ['categories' => $categories]);
    }
}
