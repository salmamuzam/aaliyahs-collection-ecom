<?php

namespace App\Livewire\Guest;

use App\Models\Review;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ProductReviews extends Component
{
    use WithPagination;
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

        // Check if verified buyer (has any order with this product)
        $isVerified = Order::where('user_id', '=', auth()->id())
            ->whereHas('items', function ($query) {
                $query->where('product_id', '=', $this->product_id);
            })->exists();

        // RESTRICTION: Only buyers can review
        if (!$isVerified) {
            LivewireAlert::title('Restricted')->text('You can only review products you have purchased.')->warning()->position('top-end')->timer(3000)->toast()->show();
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
            ->paginate(5);
    }

    public function getStatsProperty()
    {
        // Get all reviews for stats calculation (not paginated)
        $allReviews = Review::where('product_id', $this->product_id)->get();
        $total = $allReviews->count();
        if ($total == 0) {
            return [
                'average' => 0,
                'total' => 0,
                'distribution' => [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0],
                'percentages' => [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0],
            ];
        }

        $average = $allReviews->avg('rating');
        $distribution = $allReviews->groupBy('rating')->map(function ($group) {
            return $group->count();
        });

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

    public function getHasReviewedProperty()
    {
        if (!auth()->check()) {
            return false;
        }

        return Review::where('user_id', auth()->id())
            ->where('product_id', $this->product_id)
            ->exists();
    }

    public function getCanReviewProperty()
    {
        if (!auth()->check()) {
            return false;
        }

        // Must have purchased the product (any status) AND not reviewed it yet
        $hasPurchased = Order::where('user_id', auth()->id())
            ->whereHas('items', function ($query) {
                $query->where('product_id', $this->product_id);
            })->exists();

        return $hasPurchased && !$this->hasReviewed;
    }

    public function render()
    {
        return view('livewire.guest.reviews.product-reviews', [
            'reviews' => $this->reviews,
            'stats' => $this->stats,
            'canReview' => $this->canReview,
            'hasReviewed' => $this->hasReviewed,
        ]);
    }
}
