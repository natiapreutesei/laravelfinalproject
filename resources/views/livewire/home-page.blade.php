<div>
    <!-- Main Section -->
    <main class="grow mt-10">
        <section>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-2">
                <!-- Intro Section -->
                <section>
                    <div class="flex flex-col h-full p-4">
                        <h1 class="text-lg text-neutral-600 font-mono tracking-tight uppercase">
                            Romanian BookLink, the place for your next book.
                        </h1>
                        <p class="text-sm text-neutral-500 mt-2">
                            Your next minimalist ecommerce theme for all your digital products.
                        </p>
                    </div>
                </section>

                <!-- Product Cards -->
                @foreach($products as $product)
                    <div class="group relative bg-white overflow-hidden rounded-xl font-mono">
                        <div
                            class="aspect-[4/4] p-20 overflow-hidden group-hover:opacity-75 duration-300 transition-all">
                            <img alt="{{$product->name}}" src="{{ $product->image[0] }}" class="object-cover object-center">
                        </div>
                        <div class="p-4 text-sm text-neutral-500">
                            <div class="flex items-center justify-between space-x-8">
                                <h3>
                                    <a href="/products/{{ $product->slug }}" title="{{$product->name}}" aria-label="{{$product->name}}">
                                        <span aria-hidden="true" class="absolute inset-0"></span> {{$product->name}}
                                    </a>
                                </h3>
                                <p class="absolute top-4 right-4">{{format_money($product->price)}}</p>
                                <p class="mt-1">{{ $product->category->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Subscribe Section -->
        <section class="py-2">
            <div class="flex flex-col p-4 text-center py-32 bg-white rounded-xl overflow-hidden relative">
                <img class="absolute -left-32 md:scale-150 md:-bottom-32" src="/products/19.png" alt="">
                <img class="absolute -right-32 md:scale-150 md:-bottom-32" src="/products/19.png" alt="">
                <div class="max-w-xl mx-auto relative">
                    <h1 class="text-lg text-neutral-600 font-mono tracking-tight text-balance uppercase">
                        Subscribe to our all included bundle, monthly, quarterly and yearly.
                    </h1>
                    <p class="text-sm text-neutral-500 mt-2">
                        Subscribe today and enjoy more than 50,000 products in your cart.
                    </p>
                    <div class="flex justify-center mt-12">
                        <a href="#" title="link to your page" aria-label="your label"
                           class="relative group overflow-hidden pl-4 font-mono h-14 flex space-x-6 items-center bg-orange-500 hover:bg-black duration-300 rounded-xl justify-between">
                            <span class="relative uppercase text-xs text-white">Subscribe today</span>
                            <div aria-hidden="true"
                                 class="w-12 text-white transition duration-300 -translate-y-7 group-hover:translate-y-7">
                                <div class="h-14 flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-auto fill-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </div>
                                <div class="h-14 flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6 m-auto fill-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
