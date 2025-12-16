<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    public $search = '';

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
