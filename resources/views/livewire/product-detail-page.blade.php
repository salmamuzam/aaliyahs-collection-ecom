<div>
    <div class="bg-gray-100">
        <div class="container px-4 py-8 mx-auto">
            <div class="flex flex-wrap -mx-4">
                <!-- Product Images -->
                <div class="w-full px-4 mb-8 md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxfHxoZWFkcGhvbmV8ZW58MHwwfHx8MTcyMTMwMzY5MHww&ixlib=rb-4.0.3&q=80&w=1080"
                        alt="Product" class="w-full h-auto mb-4 rounded-lg shadow-md" id="mainImage">
                    <div class="flex justify-center gap-4 py-4 overflow-x-auto">
                        <img src="https://images.unsplash.com/photo-1505751171710-1f6d0ace5a85?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwxMnx8aGVhZHBob25lfGVufDB8MHx8fDE3MjEzMDM2OTB8MA&ixlib=rb-4.0.3&q=80&w=1080"
                            alt="Thumbnail 1"
                            class="object-cover transition duration-300 rounded-md cursor-pointer size-16 sm:size-20 opacity-60 hover:opacity-100"
                            onclick="changeImage(this.src)">
                        <img src="https://images.unsplash.com/photo-1484704849700-f032a568e944?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw0fHxoZWFkcGhvbmV8ZW58MHwwfHx8MTcyMTMwMzY5MHww&ixlib=rb-4.0.3&q=80&w=1080"
                            alt="Thumbnail 2"
                            class="object-cover transition duration-300 rounded-md cursor-pointer size-16 sm:size-20 opacity-60 hover:opacity-100"
                            onclick="changeImage(this.src)">
                        <img src="https://images.unsplash.com/photo-1496957961599-e35b69ef5d7c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw4fHxoZWFkcGhvbmV8ZW58MHwwfHx8MTcyMTMwMzY5MHww&ixlib=rb-4.0.3&q=80&w=1080"
                            alt="Thumbnail 3"
                            class="object-cover transition duration-300 rounded-md cursor-pointer size-16 sm:size-20 opacity-60 hover:opacity-100"
                            onclick="changeImage(this.src)">
                        <img src="https://images.unsplash.com/photo-1528148343865-51218c4a13e6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHwzfHxoZWFkcGhvbmV8ZW58MHwwfHx8MTcyMTMwMzY5MHww&ixlib=rb-4.0.3&q=80&w=1080"
                            alt="Thumbnail 4"
                            class="object-cover transition duration-300 rounded-md cursor-pointer size-16 sm:size-20 opacity-60 hover:opacity-100"
                            onclick="changeImage(this.src)">
                    </div>
                </div>

                <!-- Product Details -->
                <div class="w-full px-4 md:w-1/2">
                    <h2 class="mb-2 text-3xl font-bold">Premium Wireless Headphones</h2>
                    <p class="mb-4 text-gray-600">SKU: WH1000XM4</p>
                    <div class="mb-4">
                        <span class="mr-2 text-2xl font-bold">$349.99</span>
                    </div>

                    <p class="mb-6 text-gray-700">Experience premium sound quality and industry-leading noise
                        cancellation
                        with
                        these wireless headphones. Perfect for music lovers and frequent travelers.</p>



                    <div class="mb-6">
                        <label for="quantity" class="block mb-1 text-sm font-medium text-gray-700">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1"
                            class="w-12 text-center border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="flex mb-6 space-x-4">
                        <button
                            class="flex items-center gap-2 px-6 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                            Add to Cart
                        </button>
                        <button
                            class="flex items-center gap-2 px-6 py-2 text-gray-800 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            Wishlist
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <script>
            function changeImage(src) {
                document.getElementById('mainImage').src = src;
            }
        </script>
    </div>
</div>
