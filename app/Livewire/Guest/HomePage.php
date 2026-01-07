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
        return view('livewire.guest.home-page', [
            'categories' => \App\Models\Category::all(),
            'latestProducts' => \App\Models\Product::latest()->take(4)->get(),
        ]);
    }
}
