<?php

namespace App\Livewire\Guest;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;

class NavbarSearch extends Component
{
    public $query = '';
    public $results = [];
    public $showDropdown = false;

    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            $this->showDropdown = false;
            return;
        }

        $this->results = Product::where('name', 'like', '%' . $this->query . '%', 'and')
            ->orWhere('description', 'like', '%' . $this->query . '%', 'and')
            ->take(5)
            ->get();

        $this->showDropdown = true;
    }

    public function resetSearch()
    {
        $this->query = '';
        $this->showDropdown = false;
    }

    public function render()
    {
        return view('livewire.guest.navbar-search');
    }
}
