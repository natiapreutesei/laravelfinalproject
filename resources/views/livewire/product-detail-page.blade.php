<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-white py-11 font-mono dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Product Information -->
                <div class="flex flex-col gap-2 h-full justify-between">
                    <div>
                        <h1 class="text-lg text-neutral-600 font-mono tracking-tight text-balance">{{ $product->name }}</h1>
                        <p class="text-neutral-500 mt-2 text-sm">{!! Str::markdown($product->description) !!}</p>
                    </div>
                    <div class="gap-2 flex flex-col h-full justify-end">
                        <div class=" mt-8 bg-white p-4 rounded-xl shadow-md">
                            <label for="quantity" class="w-full pb-1 text-xl font-mono text-gray-700 border-b border-orange-300 dark:border-gray-600 dark:text-gray-400 uppercase">Quantity</label>
                            <div class="relative flex flex-row w-full h-10 mt-6 bg-transparent rounded-lg">
                                <button wire:click="decrementQuantity" class="w-20 h-full text-gray-600 bg-orange-100 rounded-l outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-orange-200">
                                    <span class="m-auto text-2xl font-mono">-</span>
                                </button>
                                <input type="number" wire:model="quantity" readonly class="flex items-center w-full font-mono text-center text-gray-700 placeholder-gray-700 bg-orange-50 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none border-none text-md hover:text-black" placeholder="1">
                                <button wire:click="incrementQuantity" class="w-20 h-full text-gray-600 bg-orange-100 rounded-r outline-none cursor-pointer dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-orange-200">
                                    <span class="m-auto text-2xl font-mono">+</span>
                                </button>
                            </div>
                        </div>

                        <a href="#" wire:click="addToCart({{ $product->id }})" title="Add to Cart" aria-label="Add to Cart" class="relative group overflow-hidden pl-4 font-mono h-14 flex space-x-6 items-center bg-orange-500 hover:bg-black duration-300 rounded-xl w-full justify-between">
                            <span wire:loading.remove wire:target="addToCart({{ $product->id }})" class="relative uppercase text-xs text-white">Add to cart</span>
                            <span wire:loading wire:target="addToCart({{ $product->id }})" >Adding...</span>
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
                    <!-- Highlights and License Cards -->
                    <div class="space-y-2 h-full">
                        <div class="bg-white rounded-xl p-4 shadow-md">
                            <h3 class="text-lg text-neutral-600 uppercase font-mono tracking-tight">Clever Highlights</h3>
                            <div class="text-neutral-500 mt-4 text-sm">
                                <ul role="list">
                                    <li>Something clever about this product</li>
                                    <li>Something even cleverer</li>
                                </ul>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4 shadow-md">
                            <h3 class="text-lg text-neutral-600 uppercase font-mono tracking-tight">Interesting Fact</h3>
                            <p class="text-neutral-500 mt-4 text-sm">Some interesting facts about your {{ $product->name }} book. </p>
                        </div>
                    </div>
                </div>
                <!-- Product Images -->
                <div class="col-span-2 flex flex-col gap-2">
                    <img src="{{ $product->image[0] }}" alt="{{ $product->name }}" class="object-center object-cover rounded-xl aspect-[3/3] w-full h-77">
                    @if(isset($product->image[1]))
                        <img src="{{ $product->image[1]}}" alt="{{ $product->name }}" class="object-center object-cover rounded-xl aspect-[4/2] w-full h-96">
                    @endif
                </div>
            </div>
            <!-- Additional Info Cards -->
            <div class="flex flex-col md:flex-row gap-2 mt-8">
                <div class="w-full md:w-1/3">
                    <div class="bg-white rounded-xl p-4 shadow-md">
                        <h3 class="text-lg text-neutral-600 uppercase font-mono tracking-tight">Slim Design</h3>
                        <p class="text-neutral-500 mt-4 text-sm">Could you have even more stuff to say?
                        Well, he have the place!</p>
                    </div>
                </div>
                <div class="w-full md:w-1/3">
                    <div class="bg-white rounded-xl p-4 shadow-md">
                        <h3 class="text-lg text-neutral-600 uppercase font-mono tracking-tight">More Space</h3>
                        <p class="text-neutral-500 mt-4 text-sm">Is space infinite here? Well, you will never know if you didn't try...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

