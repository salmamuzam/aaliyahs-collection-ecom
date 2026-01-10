<div class="sm:px-8 px-4 py-8 max-w-screen-xl mx-auto">
    <div class="h-10 w-48 bg-gray-200 animate-pulse rounded mb-8"></div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach(range(1, 4) as $i)
            <div class="bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                <div class="aspect-[3/4] bg-gray-200 animate-pulse"></div>
                <div class="p-4 space-y-3">
                    <div class="h-4 w-3/4 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-5 w-1/2 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-10 w-full bg-gray-200 animate-pulse rounded-md mt-4"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
