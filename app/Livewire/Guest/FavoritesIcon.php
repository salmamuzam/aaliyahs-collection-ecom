<?php

namespace App\Livewire\Guest;

use App\Helpers\FavoritesManagement;
use Livewire\Attributes\On;
use Livewire\Component;

class FavoritesIcon extends Component
{
    public $total_count = 0;

    public function mount()
    {
        $this->total_count = count(FavoritesManagement::getFavoriteItemsFromCookie());
    }

    #[On('update-favorite-count')]
    public function updateFavoriteCount($total_count)
    {
        $this->total_count = $total_count;
    }

    public function render()
    {
        return view('livewire.guest.navbar.favorites-icon');
    }
}
