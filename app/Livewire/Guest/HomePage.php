<?php

namespace App\Livewire\Guest;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    // Custom title
    #[Title('Home | Aaliyah Collection')]
    public function render()
    {
        // get the categories
        $categories = Category::all();
        return view('livewire.guest.home-page', [
            // pass the categories to the view
            'categories' => $categories,
        ]);
    }
}
