<div class="px-6 lg:px-12 pt-6 lg:pt-10 pb-4 lg:pb-8">
    <div class="h-10 w-48 bg-gray-200 animate-pulse rounded mb-8"></div>

    <div class="flex justify-between items-center mb-6">
        <div class="h-10 w-64 bg-gray-200 animate-pulse rounded-md"></div>
        <div class="h-10 w-32 bg-gray-200 animate-pulse rounded-md"></div>
    </div>

    <div class="hidden md:block overflow-hidden brand-card">
        <div class="h-12 w-full bg-gray-100 border-b border-gray-200"></div>
        <div class="divide-y divide-gray-200">
            @foreach(range(1, 4) as $i)
                <div class="p-4 flex gap-6 items-center h-20">
                    <div class="flex-1 space-y-2">
                        <div class="h-5 w-1/4 bg-gray-200 animate-pulse rounded"></div>
                    </div>
                    <div class="h-8 w-32 bg-gray-200 animate-pulse rounded ml-auto"></div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="md:hidden grid grid-cols-2 gap-4">
        @foreach(range(1, 4) as $i)
            <div class="brand-card p-4 space-y-3 flex flex-col items-center">
                <div class="w-16 h-16 bg-gray-200 animate-pulse rounded-full"></div>
                <div class="h-5 w-24 bg-gray-200 animate-pulse rounded"></div>
            </div>
        @endforeach
    </div>
</div>
