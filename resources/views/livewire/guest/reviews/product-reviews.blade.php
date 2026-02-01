<div class="px-4 py-8 antialiased md:py-16">
    <div class="mx-auto max-w-6xl">
        <div>
            <x-shared.sections.section-header title="CUSTOMER REVIEWS" align="center" />
        </div>

        {{-- Ratings & Breakdown --}}
        <div class="flex lg:items-center sm:justify-between max-lg:flex-col gap-x-6 gap-y-8 mt-8">
            <div class="space-y-2 w-full max-w-sm">
                @foreach([5, 4, 3, 2, 1] as $star)
                <div class="flex items-center">
                    <div class="min-w-9">
                        <p class="text-sm text-gray-900 font-medium">{{ $star }}.0</p>
                    </div>
                    <div class="bg-gray-400 rounded w-full h-3">
                        <div class="h-full rounded bg-brand-burgundy" style="width: {{ $stats['percentages'][$star] }}%"></div>
                    </div>
                    <div class="min-w-14">
                        <p class="text-sm text-gray-900 font-medium ml-4">{{ $stats['percentages'][$star] }}%</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="w-full lg:text-center">
                <h3 class="text-gray-900 text-xl font-semibold">Total Reviews</h3>
                <h6 class="text-gray-600 text-base mt-3 font-medium">{{ $stats['total'] }} Reviews</h6>
            </div>

            <div class="w-full lg:text-center">
                <h3 class="text-gray-900 text-xl font-semibold">Average Rating</h3>
                <div class="flex items-center lg:justify-center space-x-1 text-brand-burgundy mt-3">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= round($stats['average']) ? 'fill-brand-burgundy' : 'fill-gray-300' }}" viewBox="0 0 24 24">
                            <path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-sm text-gray-500 mt-1">{{ $stats['average'] }} out of 5</p>
            </div>
        </div>

        <div class="my-8 border-t border-black"></div>

        {{-- Reviews List --}}
        <div class="space-y-8 mt-12">
            @forelse($reviews as $review)
            <div class="sm:p-8 p-6 bg-gray-50 rounded-xl border border-gray-100">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div class="flex items-center gap-4">
                        <div class="shrink-0">
                            @if($review->user->profile_photo_path)
                                <img src="{{ \App\Helpers\ImageHelper::getUrl($review->user->profile_photo_path) }}" 
                                     class="object-cover rounded-full w-14 h-14 border-2 border-gray-300" 
                                     alt="{{ $review->user->first_name }}" />
                            @else
                                <div class="w-14 h-14 rounded-full bg-brand-beige flex items-center justify-center text-xl font-bold text-brand-burgundy border-2 border-gray-300">
                                    {{ substr($review->user->first_name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-[15px] text-gray-900 font-semibold">{{ $review->user->first_name }} {{ $review->user->last_name }}</p>
                            
                            @if($review->is_verified)
                            <div class="flex items-center gap-2 mt-2">
                                <span class="w-4 h-4 flex items-center justify-center rounded-full bg-green-600/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2 h-2 fill-green-700" viewBox="0 0 24 24">
                                        <path d="M9.225 20.656a1.206 1.206 0 0 1-1.71 0L.683 13.823a1.815 1.815 0 0 1 0-2.566l.855-.856a1.815 1.815 0 0 1 2.567 0l4.265 4.266L19.895 3.14a1.815 1.815 0 0 1 2.567 0l.855.856a1.815 1.815 0 0 1 0 2.566z" />
                                    </svg>
                                </span>
                                <p class="text-xs text-brand-teal font-medium">Verified Buyer</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                         {{-- Date --}}
                         <p class="text-gray-500 text-sm">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="mt-4">
                     {{-- Rating Stars --}}
                    <div class="flex items-center space-x-1 text-brand-burgundy mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-[18px] h-[18px] {{ $i <= $review->rating ? 'fill-brand-burgundy' : 'fill-gray-300' }}" viewBox="0 0 24 24">
                                <path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" />
                            </svg>
                        @endfor
                    </div>

                    <p class="text-gray-700 text-[15px] leading-relaxed">
                        {{ $review->comment }}
                    </p>
                </div>
            </div>
            @empty
                <div class="text-center py-10">
                    <p class="text-gray-500">No reviews yet.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination Links --}}
        @if($reviews->hasPages())
        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
        @endif

        {{-- Form / Message Section --}}
        <div class="mt-12">
            @if($canReview)
                <div id="write-review">
                    <h3 class="text-gray-900 text-xl font-semibold mb-6">Write Your Review</h3>
                    <form wire:submit.prevent="submitReview" class="bg-gray-50 sm:p-8 p-6 rounded-xl border border-gray-200">
                        <div>
                            <label class="mb-2 text-sm text-gray-900 font-medium block">Rate Us</label>
                            <div class="flex items-center space-x-2 mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none transition-transform active:scale-95">
                                        <svg class="w-8 h-8 {{ $i <= $rating ? 'fill-brand-burgundy' : 'fill-gray-300' }} cursor-pointer" viewBox="0 0 24 24">
                                            <path d="M12 17.42L6.25 21.54c-.29.2-.66-.09-.56-.43l2.14-6.74L2.08 10.15c-.26-.2-.13-.6.2-.62l7.07-.05L11.62 2.66c.1-.32.56-.32.66 0l2.24 6.82 7.07.05c.33.01.46.42.2.62l-5.75 4.22 2.14 6.74c.1.34-.27.63-.56.43L12 17.42z" />
                                        </svg>
                                    </button>
                                @endfor
                            </div>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label class="mb-2 text-sm text-gray-900 font-medium block">Full Name</label>
                                <div class="relative flex items-center">
                                    <input type="text" value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" readonly
                                        class="px-4 py-3 bg-gray-200 text-gray-500 w-full text-sm border border-gray-300 rounded-md cursor-not-allowed" />
                                </div>
                            </div>
                            <div>
                                <label class="mb-2 text-sm text-gray-900 font-medium block">Email</label>
                                <div class="relative flex items-center">
                                    <input type="email" value="{{ auth()->user()->email }}" readonly
                                        class="px-4 py-3 bg-gray-200 text-gray-500 w-full text-sm border border-gray-300 rounded-md cursor-not-allowed" />
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label class="mb-2 text-sm text-gray-900 font-medium block">Review</label>
                                <div>
                                    <textarea wire:model="comment"
                                        placeholder="Share your experience..."
                                        rows="4"
                                        class="px-4 py-3 w-full text-sm bg-white border border-gray-300 focus:border-brand-burgundy focus:ring-brand-burgundy outline-none transition-all rounded-md text-gray-900"></textarea>
                                    @error('comment') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="mt-8 px-6 py-3 text-[15px] font-medium bg-brand-burgundy hover:bg-opacity-90 text-white rounded-md transition-all cursor-pointer">
                            Submit Review
                        </button>
                    </form>
                </div>
            @elseif($hasReviewed)
                <div class="bg-gray-50 p-8 rounded-xl border border-gray-200 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-brand-teal mx-auto mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                    <h3 class="text-brand-black text-xl font-bold mb-2">Thank You!</h3>
                    <p class="text-gray-600 mb-4">You have already shared your experience with this product. We appreciate your feedback!</p>
                    <a href="{{ route('shop') }}" wire:navigate class="inline-block px-6 py-2 bg-brand-teal text-white rounded-md font-bold transition-all hover:bg-opacity-90">Browse More Products</a>
                </div>
            @else
                <div class="bg-gray-50 p-8 rounded-xl border border-gray-200 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-brand-teal mx-auto mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                    <h3 class="text-brand-black text-xl font-bold mb-2">Verified Reviews Only</h3>
                    @auth
                        <p class="text-gray-600 mb-4">You can only review products that you have purchased.</p>
                        <a href="{{ route('shop') }}" wire:navigate class="inline-block px-6 py-2 bg-brand-teal text-white rounded-md font-bold transition-all hover:bg-opacity-90">Continue Shopping</a>
                    @else
                        <p class="text-gray-600 mb-4">Please login to write a review for a product you've purchased.</p>
                        <a href="{{ route('login') }}" class="inline-block px-6 py-2 bg-brand-burgundy text-white rounded-md font-bold transition-all hover:bg-opacity-90">Login to Review</a>
                    @endauth
                </div>
            @endif
        </div>
    </div>
</div>
