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

    public function placeholder()
    {
        return view('livewire.placeholders.category-list-skeleton');
    }

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortColumn, $this->sortOrder)
            ->paginate(4);

        return view('livewire.admin.category-list', compact('categories'));
    }

    public function deleteCategory(Category $category)
    {
        // Terse way to handle file deletion
        if ($category->image) {
            Storage::delete($category->image);
        }

        $status = $category->delete();
        session()->flash($status ? 'success' : 'error', $status ? 'Deleted successfully!' : 'Unable to delete.');

        // Adjust pagination fluently
        $this->gotoPage(Category::count() <= ($this->activePageNumber - 1) * 4 ? max(1, $this->activePageNumber - 1) : $this->activePageNumber);
    }

    public function updatingPage($pageNumber)
    {
        $this->activePageNumber = $pageNumber;
    }
}
