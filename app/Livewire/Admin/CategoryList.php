<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Title;

use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class CategoryList extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Title('Admin Dashboard | Categories')]
    public $search = '';
    public $activePageNumber = 1;

    public $sortColumn = 'id';
    public $sortOrder = 'asc';

    public function sortBy($columnName)
    {
        if ($this->sortColumn === $columnName) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $columnName;
            $this->sortOrder = 'asc';
        }
    }

    public function fetchCategories()
    {
        return Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortColumn, $this->sortOrder)
            ->paginate(4);
    }

    public function render()
    {
        $categories = $this->fetchCategories();

        return view('livewire.admin.category-list', [
            'categories' => $categories
        ]);
    }

    public function deleteCategory(Category $category)
    {
        if ($category) {
            if (Storage::exists($category->image)) {
                Storage::delete($category->image);
            }

            $deleteResponse = $category->delete();

            if ($deleteResponse) {
                session()->flash('success', 'Category deleted successfully!');
            } else {
                session()->flash('error', 'Unable to delete category, please try again!');
            }
        } else {
            session()->flash('error', 'Category not found!');
        }

        // Check if we need to redirect to previous page
        $categories = $this->fetchCategories();
        if ($categories->isEmpty() && $this->activePageNumber > 1) {
            $this->gotoPage($this->activePageNumber - 1);
        } else {
            $this->gotoPage($this->activePageNumber);
        }
    }

    public function updatingPage($pageNumber)
    {
        $this->activePageNumber = $pageNumber;
    }
}
