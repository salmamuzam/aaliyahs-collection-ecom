<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <div class="h-10 w-48 bg-gray-200 animate-pulse rounded mb-10"></div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        @foreach(range(1, 3) as $i)
            <div class="brand-card p-6 flex items-center justify-between">
                <div class="space-y-2">
                    <div class="h-4 w-24 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-8 w-16 bg-gray-200 animate-pulse rounded"></div>
                </div>
                <div class="h-12 w-12 bg-gray-200 animate-pulse rounded-full"></div>
            </div>
        @endforeach
    </div>

    <div class="brand-card overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <div class="h-6 w-40 bg-gray-200 animate-pulse rounded"></div>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach(range(1, 4) as $i)
                <div class="p-4 flex justify-between items-center h-16">
                    <div class="h-5 w-32 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-5 w-24 bg-gray-200 animate-pulse rounded"></div>
                    <div class="h-5 w-20 bg-gray-200 animate-pulse rounded"></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
