<div>
    <div class="w-full max-w-[85rem] pt-2 pb-0 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="pt-2 pb-0 rounded-md font-poppins dark:bg-gray-800">
            <div class="px-4 py-2 mx-auto max-w-7xl lg:py-3 md:px-6">
                <div class="flex flex-wrap mb-5 -mx-3">
                    <div class="w-full px-3 lg:w-1/4 lg:block">
                        <div class="p-4 mb-5 bg-white border border-gray-300 rounded-md">
                            <div class="h-6 w-32 bg-gray-200 rounded animate-pulse mb-2"></div>
                            <div class="w-16 mb-4 border-b border-gray-200"></div>
                            <ul>
                                @foreach(range(1,5) as $i)
                                <li class="mb-4">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 bg-gray-200 rounded animate-pulse mr-2"></div>
                                        <div class="h-4 w-24 bg-gray-200 rounded animate-pulse"></div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="p-4 mb-5 bg-white border border-gray-300 rounded-md">
                            <div class="h-6 w-20 bg-gray-200 rounded animate-pulse mb-2"></div>
                            <div class="w-16 mb-4 border-b border-gray-200"></div>
                            <div>
                                <div class="h-4 w-24 bg-gray-200 rounded animate-pulse mb-4"></div>
                                <div class="w-full h-1 bg-gray-200 rounded animate-pulse mb-4"></div>
                                <div class="flex justify-between">
                                    <div class="h-4 w-16 bg-gray-200 rounded animate-pulse"></div>
                                    <div class="h-4 w-16 bg-gray-200 rounded animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-3 lg:w-3/4">
                        <div class="mb-4">
                            <div class="flex items-center justify-between px-3 py-2 bg-white rounded-md border border-gray-300">
                                <div class="h-8 w-48 bg-gray-200 rounded animate-pulse"></div>
                                <div class="h-10 w-48 bg-gray-200 rounded animate-pulse"></div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-3 max-xl:gap-4 gap-6">
                            @foreach(range(1,6) as $i)
                            <div class="group flex flex-col bg-white border border-gray-300 rounded-lg overflow-hidden h-full">
                                <div class="aspect-[3/4] w-full bg-gray-200 animate-pulse relative"></div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <div class="h-3 w-16 bg-gray-200 rounded animate-pulse mb-2"></div>
                                    <div class="h-5 w-3/4 bg-gray-200 rounded animate-pulse mb-1"></div>
                                    <div class="h-5 w-1/2 bg-gray-200 rounded animate-pulse mb-3"></div>
                                    <div class="flex items-baseline gap-2 mt-auto">
                                        <div class="h-6 w-20 bg-gray-200 rounded animate-pulse"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
