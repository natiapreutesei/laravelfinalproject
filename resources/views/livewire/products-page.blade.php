<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="py-10 bg-gray-50 font-mono dark:bg-gray-800 rounded-lg">
        <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <!-- Filter Section -->
                <div class="w-full pr-2 lg:w-1/4 lg:block">
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Categories</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-orange-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach($categories as $category)
                                <li class="mb-4" wire:key="{{ $category->id }}">
                                    <label for="{{ $category->slug }}" class="flex items-center dark:text-gray-400">
                                        <input type="checkbox" wire:model.live="selected_categories" id="{{ $category->slug }}" value="{{ $category->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Brand</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-orange-600 dark:border-gray-400"></div>
                        <ul>
                            @foreach($publishers as $publisher)
                                <li class="mb-4" wire:key="{{ $publisher->id }}">
                                    <label for="{{ $publisher->slug }}" class="flex items-center dark:text-gray-400">
                                        <input type="checkbox" wire:model.live="selected_publishers" id="{{ $publisher->slug }}" value="{{ $publisher->id }}" class="w-4 h-4 mr-2">
                                        <span class="text-lg">{{ $publisher->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Product Status</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-orange-600 dark:border-gray-400"></div>
                        <ul>
                            <li class="mb-4">
                                <label for="featured" class="flex items-center dark:text-gray-300">
                                    <input type="checkbox" id="featured" wire:model.live="featured" value="1" class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">Featured Products</span>
                                </label>
                            </li>
                            <li class="mb-4">
                                <label for="on_sale" class="flex items-center dark:text-gray-300">
                                    <input type="checkbox" id="on_sale" wire:model.live="on_sale" value="1" class="w-4 h-4 mr-2">
                                    <span class="text-lg dark:text-gray-400">On Sale</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
                        <h2 class="text-2xl font-bold dark:text-gray-400">Price</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-orange-600 dark:border-gray-400"></div>
                        <div>
                            <div>{{ format_money($price_range * 100) }}</div>
                            <input type="range" wire:model.live="price_range" class="w-full h-1 mb-4 bg-orange-100 rounded appearance-none cursor-pointer" max="50" min="5" value="5" step="1">
                            <div class="flex justify-between">
                                <span class="inline-block text-lg font-bold text-orange-400">{{ format_money(5 * 100) }}</span>
                                <span class="inline-block text-lg font-bold text-orange-400">{{ format_money(50 * 100) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Grid Section -->
                <div class="w-full px-3 lg:w-3/4">
                    <div class="px-3 mb-4">
                        <div class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900">
                            <div class="flex items-center justify-between">
                                <select wire:model.live="sort" class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                                    <option value="latest">Sort by latest</option>
                                    <option value="price">Sort by Price</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($products as $product)
                            <div class="group relative bg-white overflow-hidden rounded-xl font-mono shadow-md hover:shadow-lg transform transition-transform duration-300 hover:scale-105" wire:key="{{ $product->id }}">
                                <a href="/products/{{ $product->slug }}" class="block">
                                    <img src="{{ $product->image[0] }}" alt="{{ $product->name }}" class="object-cover w-full h-56">
                                </a>
                                <div class="p-4 text-sm text-neutral-500">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-300 group-hover:text-orange-500 truncate">
                                            <a href="/products/{{ $product->slug }}" title="{{$product->name}}" aria-label="{{$product->name}}">{{ $product->name }}</a>
                                        </h3>
                                        <p class="text-green-600 dark:text-green-600">{{ format_money($product->price) }}</p>
                                    </div>
                                </div>
                                <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                                    <a wire:click.prevent="addToCart({{ $product->id }})" href="#" class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                                        </svg>
                                        <span wire:loading.remove wire:target="addToCart({{ $product->id }})">Add to Cart</span>
                                        <span wire:loading wire:target="addToCart({{ $product->id }})">Adding...</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="flex justify-end mt-6">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
