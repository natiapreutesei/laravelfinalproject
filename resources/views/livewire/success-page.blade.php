<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
<section class="flex items-center font-poppins dark:bg-gray-800 ">
    <div class="justify-center flex-1 max-w-6xl px-4 py-4 mx-auto bg-white border rounded-md dark:border-gray-900 dark:bg-gray-900 md:py-10 md:px-10">
        <div>
            <h1 class="px-4 mb-8 text-2xl font-semibold font-mono tracking-wide text-gray-700 dark:text-gray-300 ">
                Thank you. Your order has been received. </h1>
            <div class="flex border-b border-gray-200 dark:border-gray-700  items-stretch justify-start w-full h-full px-4 mb-8 md:flex-row xl:flex-col md:space-x-6 lg:space-x-8 xl:space-x-0">
                <div class="flex items-start justify-start flex-shrink-0">
                    <div class="flex items-center justify-center w-full pb-6 space-x-4 md:justify-start">
                        <div class="flex flex-col items-start justify-start space-y-2">
                            <p class="text-lg font-semibold font-mono leading-4 text-left text-gray-800 dark:text-gray-400">
                                {{$latest_order->address->name}}</p>
                            <p class="font-mono text-sm leading-4 text-gray-600 dark:text-gray-400">{{$latest_order->address->street_address}}</p>
                            <p class="font-mono text-sm leading-4 text-gray-600 dark:text-gray-400">{{$latest_order->address->city}}, {{$latest_order->address->state}}, {{$latest_order->address->zip_code}}</p>
                            <p class="font-mono text-sm leading-4 cursor-pointer dark:text-gray-400">Phone: {{$latest_order->address->phone}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-center pb-4 mb-10 border-b border-gray-200 dark:border-gray-700">
                <div class="w-full px-4 mb-4 md:w-1/4">
                    <p class="font-mono mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                        Order Number: </p>
                    <p class="font-mono text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">
                        {{$latest_order->id}}</p>
                </div>
                <div class="w-full px-4 mb-4 md:w-1/4">
                    <p class="font-mono mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                        Date: </p>
                    <p class="font-mono text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">
                        {{$latest_order->created_at->format('d, M Y')}}</p>
                </div>
                <div class="w-full px-4 mb-4 md:w-1/4">
                    <p class="font-mono mb-2 text-sm font-medium leading-5 text-gray-800 dark:text-gray-400 ">
                        Total: </p>
                    <p class="font-mono text-base font-semibold leading-4 text-orange-600 dark:text-gray-400">
                        {{format_money($latest_order->grand_total)}}</p>
                </div>
                <div class="w-full px-4 mb-4 md:w-1/4">
                    <p class="font-mono mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                        Payment Method: </p>
                    <p class="font-mono text-base font-semibold leading-4 text-gray-800 dark:text-gray-400 ">
                        {{$latest_order->payment_method}}</p>
                </div>
            </div>
            <div class="px-4 mb-10">
                <div class="flex flex-col items-stretch justify-center w-full space-y-4 md:flex-row md:space-y-0 md:space-x-8">
                    <div class="flex flex-col w-full space-y-6 ">
                        <h2 class="mb-2 text-xl font-semibold font-mono text-gray-700 dark:text-gray-400">Order details</h2>
                        <div class="flex flex-col items-center justify-center w-full pb-4 space-y-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between w-full">
                                <p class="font-mono text-base leading-4 text-gray-800 dark:text-gray-400">Subtotal</p>
                                <p class="font-mono text-base leading-4 text-gray-600 dark:text-gray-400"> {{format_money($latest_order->grand_total)}}</p>
                            </div>
                            <div class="flex items-center justify-between w-full">
                                <p class="font-mono text-base leading-4 text-gray-800 dark:text-gray-400">Shipping</p>
                                <p class="font-mono text-base leading-4 text-gray-600 dark:text-gray-400">{{format_money(0)}}</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between w-full">
                            <p class="font-mono text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">Total</p>
                            <p class="font-mono text-base font-semibold leading-4 text-gray-600 dark:text-gray-400">{{format_money($latest_order->grand_total)}}</p>
                        </div>
                    </div>
                    <div class="flex flex-col w-full px-2 space-y-4 md:px-8 ">
                        <h2 class="mb-2 text-xl font-semibold font-mono text-gray-700 dark:text-gray-400">Shipping</h2>
                        <div class="flex items-start justify-between w-full">
                            <div class="flex items-center justify-center space-x-2">
                                <div class="w-8 h-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 text-orange-600 dark:text-blue-400 bi bi-truck" viewBox="0 0 16 16">
                                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="flex flex-col items-center justify-start">
                                    <p class="text-lg font-mono leading-6 text-gray-800 dark:text-gray-400">
                                        Delivery<br><span class="text-sm font-normal">Delivery within 24 Hours</span>
                                    </p>
                                </div>
                            </div>
                            <p class="text-lg font-mono leading-6 text-gray-800 dark:text-gray-400">{{format_money(0)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-start gap-4 px-4 mt-6">
                <a href="/products" class="relative group overflow-hidden pl-4 font-mono h-14 flex space-x-6 items-center bg-gray-500 hover:bg-black duration-300 rounded-xl w-full md:w-auto justify-between text-white">
                    <span class="relative uppercase text-xs">Go back shopping</span>
                    <div aria-hidden="true" class="w-12 text-white transition duration-300 -translate-y-7 group-hover:translate-y-7">
                        <div class="h-14 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 m-auto fill-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"></path>
                            </svg>
                        </div>
                        <div class="h-14 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 m-auto fill-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"></path>
                            </svg>
                        </div>
                    </div>
                </a>
                <a href="/my-orders" class="relative group overflow-hidden pl-4 font-mono h-14 flex space-x-6 items-center bg-orange-500 hover:bg-black duration-300 rounded-xl w-full md:w-auto justify-between text-white">
                    <span class="relative uppercase text-xs">View My Orders</span>
                    <div aria-hidden="true" class="w-12 text-white transition duration-300 -translate-y-7 group-hover:translate-y-7">
                        <div class="h-14 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 m-auto fill-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"></path>
                            </svg>
                        </div>
                        <div class="h-14 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 m-auto fill-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
</div>
