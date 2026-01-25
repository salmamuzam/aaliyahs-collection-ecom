<?php

namespace App\Livewire\Guest;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

#[Title('Categories - Aaliyah Collection')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::all();
        return view('livewire.guest.categories-page', [
            'categories' => $categories
        ]);
    }
}
