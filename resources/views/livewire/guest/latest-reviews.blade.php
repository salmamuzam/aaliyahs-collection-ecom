<div class="py-10 px-6 sm:px-16 border-y border-gray-100" style="background-color: #ebeeec;">
    <div class="max-w-screen-xl mx-auto">
        <x-section-header title="CUSTOMER REVIEWS" align="center" />
        <p class="text-[15px] mt-6 leading-relaxed text-slate-600 text-center max-w-2xl mx-auto">Discover why fashion enthusiasts trust Aaliyah Collection. Real feedback from real people experiencing our premium fits.</p>
    </div>

    @if($reviews->count() > 0)
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-20 max-w-6xl max-lg:max-w-3xl max-md:max-w-md mx-auto mt-16">
        @foreach($reviews as $review)
        <div class="w-full p-4 rounded-md mx-auto shadow-sm border border-gray-300 bg-white relative">
            <div class="w-[76px] h-[76px] rounded-full overflow-hidden absolute right-0 left-0 mx-auto -top-10 border-2 border-brand-burgundy bg-white shadow-sm z-10">
                @if($review->user->profile_photo_path)
                    <img src="{{ Storage::url($review->user->profile_photo_path) }}" class="w-full h-full object-cover" alt="{{ $review->user->first_name }}" />
                @else
                    <div class="w-full h-full bg-brand-beige flex items-center justify-center text-brand-burgundy font-bold text-2xl uppercase">
                        {{ substr($review->user->first_name, 0, 1) }}{{ substr($review->user->last_name, 0, 1) }}
                    </div>
                @endif
            </div>

            <div class="mt-8 text-center">
                <p class="text-[15px] text-slate-700 font-normal leading-relaxed italic">"{{ $review->comment }}"</p>
            </div>

            <div class="mt-4 text-center">
                <h4 class="text-slate-900 text-[15px] whitespace-nowrap font-semibold uppercase tracking-wide">{{ $review->user->first_name }} {{ $review->user->last_name }}</h4>
                <p class="text-xs text-brand-teal font-bold uppercase mt-1">{{ $review->product->name }}</p>
            </div>

            <div class="flex justify-center space-x-1 mt-3">
                @for($i = 1; $i <= 5; $i++)
                <svg class="w-3.5 h-3.5 {{ $i <= $review->rating ? 'fill-brand-burgundy' : 'fill-[#CED5D8]' }}" viewBox="0 0 14 13" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                </svg>
                @endfor
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="mt-16 text-center">
        <p class="text-slate-400 italic">No reviews yet to display. Your story could be the first!</p>
    </div>
    @endif
</div>

