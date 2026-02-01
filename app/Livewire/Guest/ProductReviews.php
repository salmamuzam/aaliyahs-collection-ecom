<?php

namespace App\Livewire\Guest;

use App\Models\Review;
use App\Models\Order;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ProductReviews extends Component
{
    public $product_id;
    public $rating = 5;
    public $comment = '';
    public $name = '';
    public $email = '';

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|min:10',
    ];

    public function mount($product_id)
    {
        $this->product_id = $product_id;
        if (auth()->check()) {
            $this->name = auth()->user()->first_name . ' ' . auth()->user()->last_name;
            $this->email = auth()->user()->email;
        }
    }

    public $showModal = false;

    // ... existing properties ...

    public function submitReview()
    {
        if (!auth()->check()) {
            LivewireAlert::title('Error')->text('Please login to submit a review.')->error()->position('top-end')->timer(3000)->toast()->show();
            return;
        }

        $this->validate();

        // Check if user has already reviewed this product
        $existingReview = Review::where('user_id', '=', auth()->id(), 'and')
            ->where('product_id', '=', $this->product_id, 'and')
            ->first();

        if ($existingReview) {
            LivewireAlert::title('Warning')->text('You have already reviewed this product.')->warning()->position('top-end')->timer(3000)->toast()->show();
            $this->showModal = false; // Close modal if already reviewed
            return;
        }

        // Check if verified buyer (has a delivered order with this product)
        $isVerified = Order::where('user_id', '=', auth()->id())
            ->where('status', '=', 'delivered')
            ->whereHas('items', function ($query) {
                $query->where('product_id', '=', $this->product_id);
            })->exists();

        // RESTRICTION: Only verified buyers can review (Layer 3 Authorization)
        if (!$isVerified) {
            LivewireAlert::title('Restricted')->text('You can only review products you have purchased and received.')->warning()->position('top-end')->timer(3000)->toast()->show();
            $this->showModal = false;
            return;
        }

        Review::create([
            'product_id' => $this->product_id,
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
            'is_verified' => $isVerified,
        ]);

        $this->comment = '';
        $this->rating = 5;
        $this->showModal = false; // Close modal on success

        LivewireAlert::title('Success!')->text('Review submitted successfully!')->success()->position('top-end')->timer(3000)->toast()->show();
    }

    public function getReviewsProperty()
    {
        return Review::with('user')
            ->where('product_id', $this->product_id)
            ->latest()
            ->get();
    }

    public function getStatsProperty()
    {
        $reviews = $this->reviews;
        $total = $reviews->count();
        if ($total == 0) {
            return [
                'average' => 0,
                'total' => 0,
                'distribution' => [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0],
                'percentages' => [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0],
            ];
        }

        $average = $reviews->avg('rating');
        $distribution = $reviews->groupBy('rating')->map->count();

        $percentages = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $distribution->get($i, 0);
            $percentages[$i] = round(($count / $total) * 100);
        }

        return [
            'average' => round($average, 1),
            'total' => $total,
            'distribution' => $distribution,
            'percentages' => $percentages,
        ];
    }

    public function getCanReviewProperty()
    {
        if (!auth()->check()) {
            return false;
        }

        return Order::where('user_id', auth()->id())
            ->where('status', 'delivered')
            ->whereHas('items', function ($query) {
                $query->where('product_id', $this->product_id);
            })->exists();
    }

    public function render()
    {
        return view('livewire.guest.reviews.product-reviews', [
            'reviews' => $this->reviews,
            'stats' => $this->stats,
            'canReview' => $this->canReview,
        ]);
    }
}
