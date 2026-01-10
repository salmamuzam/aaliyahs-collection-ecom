<?php

namespace App\Livewire\Guest;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomePage extends Component
{
    // Custom title
    #[Title('Home | Aaliyah Collection')]
    public function placeholder()
    {
        return view('livewire.placeholders.home-skeleton');
    }

    public function getCategoriesProperty()
    {
        return \Illuminate\Support\Facades\Cache::remember('home_categories', 3600, function () {
            return \App\Models\Category::all();
        });
    }

    public function getLatestProductsProperty()
    {
        return \Illuminate\Support\Facades\Cache::remember('home_latest_products', 600, function () {
            return \App\Models\Product::latest()->take(4)->get();
        });
    }

    public function render()
    {
        return view('livewire.guest.home-page');
    }
}
