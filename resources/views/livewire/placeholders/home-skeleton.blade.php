<div>
    <section class="px-3 py-5 lg:py-10">
        <div class="grid items-center gap-5 lg:grid-cols-2 justify-items-center">
            <div class="flex flex-col items-center justify-center order-2 lg:order-1">
                <div class="h-10 md:h-20 w-48 md:w-80 bg-gray-200 animate-pulse rounded mb-4"></div>
                <div class="h-10 md:h-20 w-64 md:w-96 bg-gray-200 animate-pulse rounded mb-4"></div>
                <div class="h-4 md:h-6 w-32 md:w-48 bg-gray-200 animate-pulse rounded mb-8"></div>
                <div class="h-12 w-32 md:h-14 md:w-44 bg-gray-200 animate-pulse rounded-md mt-6"></div>
            </div>
            <div class="order-1 lg:order-2">
                <div class="h-80 w-80 lg:w-[500px] lg:h-[500px] bg-gray-200 animate-pulse rounded-md"></div>
            </div>
        </div>
    </section>

    <div class="bg-brand-teal/10 py-10 px-6 sm:px-8">
        <div class="max-w-screen-xl mx-auto flex flex-col items-center">
            <div class="h-8 w-48 bg-gray-200 animate-pulse rounded mb-10"></div>
            <div class="h-4 w-full max-w-2xl bg-gray-200 animate-pulse rounded mb-2"></div>
            <div class="h-4 w-2/3 max-w-xl bg-gray-200 animate-pulse rounded"></div>
        </div>
    </div>

    <div class="sm:p-8 p-6">
        <div class="max-w-screen-xl mx-auto flex flex-col items-center">
            <div class="h-8 w-64 bg-gray-200 animate-pulse rounded mb-12"></div>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4 w-full">
                @foreach(range(1, 4) as $i)
                    <div class="aspect-square bg-gray-200 animate-pulse rounded-md p-4 flex flex-col justify-end">
                        <div class="h-4 w-1/2 bg-white/50 rounded mx-auto"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
