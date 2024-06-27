<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto font-mono">
        <!-- Publishers Section -->
        <section id="publishers" class="mt-16">
            <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
                <h2 class="text-lg font-mono tracking-tight uppercase mb-6">
                    Publishers
                </h2>
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-2">
                    @foreach($publishers as $publisher)
                        <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 transform transition-transform duration-300 hover:scale-105">
                            <a href="/products?selected_publishers[0]={{ $publisher->id }}">
                                <img src="{{ $publisher->image }}" alt="{{$publisher->name}}" class="object-cover w-full h-64 rounded-t-lg">
                            </a>
                            <div class="p-5 text-center">
                                <a href="/products?selected_publishers[0]={{ $publisher->id }}" class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300 hover:text-orange-500">
                                    {{ $publisher->name }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section id="categories" class="mt-16">
            <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
                <h2 class="text-lg font-mono tracking-tight uppercase mb-6">
                    Categories
                </h2>
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-2">
                    @foreach($categories as $category)
                        <div class="bg-white rounded-lg shadow-md dark:bg-gray-800 transform transition-transform duration-300 hover:scale-105">
                            <a href="/products?selected_categories[0]={{ $category->id }}" wire:key="{{ $category->id }}">
                                <img src="{{ $category->image }}" alt="{{$category->name}}" class="object-cover w-full h-64 rounded-t-lg ">
                            </a>
                            <div class="p-5 text-center">
                                <a href="/products?selected_categories[0]={{ $category->id }}" class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300 hover:text-orange-500">
                                    {{ $category->name }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
