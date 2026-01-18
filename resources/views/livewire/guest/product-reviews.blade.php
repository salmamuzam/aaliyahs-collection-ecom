<section class="py-8 antialiased md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        {{-- Header Section --}}
        {{-- Header Section --}}
        <div class="mb-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 uppercase tracking-widest">Customer Reviews</h2>
                    <p class="mt-2 text-[15px] text-gray-600 max-w-2xl">Discover why fashion enthusiasts trust Aaliyah Collection. Real feedback from real people experiencing our premium fits.</p>
                </div>
            </div>
            
            <div class="mt-4 flex items-center gap-2">
                <div class="flex items-center gap-0.5">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="h-4 w-4 {{ $i <= round($stats['average']) ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                        </svg>
                    @endfor
                </div>
                <p class="text-sm font-medium leading-none text-gray-700">({{ $stats['average'] }})</p>
                <a href="#" class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline">{{ $stats['total'] }} Reviews</a>
            </div>
        </div>

        {{-- Summary & Breakdown --}}
        <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
            <div class="shrink-0 space-y-4">
                <p class="text-2xl font-semibold leading-none text-gray-900">{{ $stats['average'] }} out of 5</p>
                @auth
                    <button type="button" wire:click="$set('showModal', true)" class="mb-2 me-2 rounded-lg bg-brand-burgundy px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-burgundy/90 focus:outline-none focus:ring-4 focus:ring-brand-burgundy/30 transition-all">Write a review</button>
                @else
                    <a href="/login" class="mb-2 me-2 inline-block rounded-lg bg-brand-burgundy px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-burgundy/90 focus:outline-none focus:ring-4 focus:ring-brand-burgundy/30 transition-all">Log in to review</a>
                @endauth
            </div>

            <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                @foreach([5, 4, 3, 2, 1] as $star)
                <div class="flex items-center gap-2">
                    <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900">{{ $star }}</p>
                    <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                    </svg>
                    <div class="h-1.5 w-80 rounded-full bg-black/10">
                        <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{ $stats['percentages'][$star] }}%"></div>
                    </div>
                    <span class="w-8 shrink-0 text-right text-sm font-medium leading-none text-slate-800 hover:underline sm:w-auto sm:text-left">{{ $stats['distribution'][$star] ?? 0 }} <span class="hidden sm:inline">reviews</span></span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Reviews List --}}
        <div class="mt-6 divide-y divide-gray-400 border-t border-gray-400 pt-6">
            @forelse($reviews as $review)
            <div class="gap-3 py-6 sm:flex sm:items-start">
                <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                    {{-- Review Stars --}}
                    <div class="flex items-center gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                        @endfor
                    </div>

                    {{-- User Info --}}
                    <div class="flex items-center gap-2">
                         @if($review->user->profile_photo_path)
                            <img src="{{ Storage::url($review->user->profile_photo_path) }}" alt="{{ $review->user->first_name }}" class="w-6 h-6 rounded-full object-cover">
                        @else
                            <div class="w-6 h-6 rounded-full bg-brand-beige flex items-center justify-center text-xs font-bold text-brand-burgundy ring-1 ring-brand-burgundy/20">
                                {{ substr($review->user->first_name, 0, 1) }}
                            </div>
                        @endif
                        <p class="text-base font-semibold text-gray-900">{{ $review->user->first_name }} {{ $review->user->last_name }}</p>
                    </div>
                    <p class="text-sm font-normal text-gray-600">{{ $review->created_at->format('F d, Y') }}</p>

                    @if($review->is_verified)
                    <div class="inline-flex items-center gap-1">
                        <svg class="h-5 w-5 text-brand-teal" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-sm font-medium text-gray-900">Verified purchase</p>
                    </div>
                    @endif
                </div>

                <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                    <p class="text-base font-normal text-gray-700 leading-relaxed">
                        {{ $review->comment }}
                    </p>
                </div>
            </div>
            @empty
                <div class="py-12 text-center">
                    <p class="text-gray-500">No reviews yet. Be the first to share your thoughts!</p>
                </div>
            @endforelse
        </div>

        @if($reviews->count() > 5)
        <div class="mt-6 text-center">
            <button type="button" class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-brand-burgundy focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">View more reviews</button>
        </div>
        @endif
    </div>

    {{-- Review Modal --}}
    @if($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 overflow-y-auto overflow-x-hidden p-4 md:inset-0">
        <div class="relative w-full max-w-2xl max-h-full rounded-lg bg-white shadow-xl">
            {{-- Modal header --}}
            <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 md:p-5">
                <div>
                    <h3 class="mb-1 text-lg font-semibold text-gray-900">Write a review</h3>
                </div>
                <button type="button" wire:click="$set('showModal', false)" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900">
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            {{-- Modal body --}}
            <form wire:submit.prevent="submitReview" class="p-4 md:p-5">
                <div class="mb-4 grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900">Your Rating</label>
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" wire:click="$set('rating', {{ $i }})" class="focus:outline-none transition-transform active:scale-95">
                                    <svg class="h-8 w-8 {{ $i <= $rating ? 'text-yellow-300' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                </button>
                            @endfor
                            <span class="ms-2 text-lg font-bold text-gray-900">{{ $rating }} out of 5</span>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label for="description" class="mb-2 block text-sm font-medium text-gray-900">Review description</label>
                        <textarea wire:model="comment" id="description" rows="6" class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-brand-burgundy focus:ring-brand-burgundy" placeholder="Share your experience..."></textarea>
                         @error('comment') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-2">
                        <div class="flex items-center">
                            <input id="review-checkbox" type="checkbox" class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-brand-burgundy focus:ring-2 focus:ring-brand-burgundy" />
                            <label for="review-checkbox" class="ms-2 text-sm font-medium text-gray-500">By publishing this review you agree with the <a href="#" class="text-brand-burgundy hover:underline">terms and conditions</a>.</label>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4 md:pt-5 flex justify-end gap-3">
                     <button type="button" wire:click="$set('showModal', false)" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-100">Cancel</button>
                    <button type="submit" class="inline-flex items-center rounded-lg bg-brand-burgundy px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-brand-burgundy/90 focus:outline-none focus:ring-4 focus:ring-brand-burgundy/30">Add review</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</section>
</section>
