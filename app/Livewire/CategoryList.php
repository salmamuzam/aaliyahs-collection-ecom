<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('livewire.category-list', ['categories' => $categories]);
    }
}
