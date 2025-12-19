<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Title;

class CategoryList extends Component
{
    #[Title('Admin Dashboard | Categories')]
    public $search = '';

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'DESC')
            ->get();

        return view('livewire.category-list', [
            'categories' => $categories
        ]);
    }
    // public $categories;

    // // Fetch the categories from the table
    // public function mount()
    // {
    //     $this->categories = Category::all();
    // }
    // public function render()
    // {
    //     $categories = Category::where('name', 'like', '%' . $this->search . '%')
    //                  ->get();

    //     return view('livewire.category-list', [
    //         'categories' => $categories
    //     ]);
    // }

    // Delete functionality

    public function deleteCategory(Category $category)
    {
        // If category is available, delete it
        if ($category) {
            // if the image exists, remove the image from the storage
            if (Storage::exists($category->image)) {
                // delete the image
                Storage::delete($category->image);
            }
            ;
            // delete the category
            $deleteResponse = $category->delete();

            if ($deleteResponse) {
                session()->flash('success', 'Category deleted successfully!');
            } else {
                session()->flash('error', 'Unable to delete category, please try again!');
            }
        } else {
            session()->flash('error', 'Category not found!');
        }

        // redirect to the category listing page
        // prevent page reload
        return $this->redirect('/categories', navigate: true);
    }
}
