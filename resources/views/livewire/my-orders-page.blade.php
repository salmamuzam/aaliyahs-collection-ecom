<section class="py-8 antialiased bg-white dark:bg-gray-900 md:py-16">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="max-w-5xl mx-auto">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My orders</h2>

                <div class="gap-4 mt-6 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                    <div>
                        <label for="order-type"
                            class="block mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Select order
                            type</label>
                        <select id="order-type"
                            class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            <option selected>All orders</option>
                            <option value="pre-order">Pre-order</option>
                            <option value="transit">In transit</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <span class="inline-block text-gray-500 dark:text-gray-400"> from </span>

                    <div>
                        <label for="duration"
                            class="block mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Select
                            duration</label>
                        <select id="duration"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            <option selected>this week</option>
                            <option value="this month">this month</option>
                            <option value="last 3 months">the last 3 months</option>
                            <option value="lats 6 months">the last 6 months</option>
                            <option value="this year">this year</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flow-root mt-6 sm:mt-8">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($orders as $order)
                    <div class="flex flex-wrap items-center py-6 gap-y-4">
                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                <a href="#" class="hover:underline">{{ $order->id }}</a>
                            </dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $order->created_at->format('d-m-Y') }}</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">LKR {{ $order->grand_total }}</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                            <dd
                                class="me-2 mt-1.5 inline-flex items-center rounded bg-primary-100 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">

                              {{ $order->status }}
                            </dd>
                        </dl>



                            <a href="/my-orders/{{ $order->id }}"
                                class="inline-flex justify-center w-full px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 lg:w-auto">View
                                details</a>

                    </div>
@endforeach


                </div>
            </div>

            {{ $orders->links() }}
        </div>
    </div>
</section>
