<?php

namespace App\Livewire\Guest;

use App\Models\Review;
use Livewire\Component;

class LatestReviews extends Component
{
    /**
     * INNOVATION: Fetching Top 3 Reviews for Social Proof on Home Page
     */
    public function getReviewsProperty()
    {
        return Review::with(['user', 'product'])
            ->latest()
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.guest.latest-reviews', [
            'reviews' => $this->reviews
        ]);
    }
}
