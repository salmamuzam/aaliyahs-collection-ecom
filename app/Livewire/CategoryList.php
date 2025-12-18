<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public $categories;

    // Fetch the categories from the table
    public function mount()
    {
        $this->categories = Category::all();
    }
    public function render()
    {
        return view('livewire.category-list');
    }
}
