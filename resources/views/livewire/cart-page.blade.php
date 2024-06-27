<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <main class="grow">
        <section>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-2">
                <div class="flex flex-col gap-2 h-full justify-between">
                    <div>
                        <h1 class="text-lg text-neutral-600 font-mono tracking-tight text-balance">
                            WHAT'S IN YOUR CART
                        </h1>
                        <p class="text-neutral-500 font-mono mt-2 text-sm">
                            Write some text here.
                        </p>
                    </div>
                </div>
                <div class="lg:col-span-2 space-y-2">
                    <div>
                        <ul role="list" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                            @forelse($cart_items as $item)
                                <li x-data="{ show: true }" x-show="show">
                                    <div class="flex flex-col gap-2 relative p-4 bg-white rounded-xl">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="aspect-[4/2] flex-none rounded-lg bg-neutral-200 object-cover object-center">
                                        <div class="flex flex-col justify-between w-full">
                                            <div class="text-sm">
                                                <h3 class="text-lg text-neutral-600 uppercase font-mono tracking-tight">{{ $item['name'] }}</h3>
                                                <p class="text-neutral-500 font-mono">{{ format_money($item['unit_amount']) }} — <span class="text-orange-600">{{ $item['quantity'] }}</span> {{ $item['quantity'] > 1 ? 'units' : 'unit' }}</p>
                                                <p class="text-neutral-500 font-mono text-balance mt-8">{{ $item['description'] }}</p>
                                            </div>
                                            <div class="flex items-center justify-between mt-4">
                                                <button wire:click="decrementItemQuantity({{ $item['product_id'] }})" wire:loading.attr="disabled" wire:target="decrementItemQuantity({{ $item['product_id'] }})" class="relative group px-4 py-2 text-xs text-orange-600 uppercase font-mono bg-neutral-100 hover:bg-neutral-200 hover:text-orange-600 duration-300 rounded-lg">
                                                    -
                                                </button>
                                                <span class="mx-4 font-mono text-sm text-orange-400">Add or remove units</span>
                                                <button wire:click="incrementItemQuantity({{ $item['product_id'] }})" wire:loading.attr="disabled" wire:target="incrementItemQuantity({{ $item['product_id'] }})" class="relative group px-4 py-2 text-xs text-orange-600 uppercase font-mono bg-neutral-100 hover:bg-neutral-200 hover:text-orange-600 duration-300 rounded-lg">
                                                    +
                                                </button>
                                            </div>
                                            <div class="flex ml-auto mt-16">
                                                <button wire:click="removeItem({{ $item['product_id'] }})" wire:loading.attr="disabled" wire:target="removeItem({{ $item['product_id'] }})" type="submit" title="link to your page" aria-label="your label" class="relative group px-6 justify-center text-xs text-orange-600 uppercase font-mono h-8 flex items-center bg-neutral-100 hover:bg-neutral-200 hover:text-orange-600 duration-300 rounded-lg w-full">
                                                    <span class="sr-only">Remove</span>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center py-4 font-semibold text-4xl text-orange-500">No items in the cart!</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="bg-white p-4 rounded-xl">
                        <div class="flex-none pt-2">
                            <dl class="space-y-6 text-sm text-neutral-500 font-mono">
                                <div class="flex justify-between">
                                    <dt class="text-lg text-neutral-600 uppercase font-mono tracking-tight">Subtotal</dt>
                                    <dd class="text-neutral-500 font-mono">{{ format_money($grand_total) }}</dd>
                                </div>
                                {{-- <div class="flex justify-between">
                                     <dt class="flex">
                                         <span class="text-lg text-neutral-600 uppercase font-mono tracking-tight">Discount</span>
                                         <span class="ml-2 rounded-md bg-neutral-100 px-2 py-0.5 inline-flex items-center text-xs tracking-wide text-orange-600 uppercase">DISCOUNT30</span>
                                     </dt>
                                     <dd class="text-neutral-500 font-mono">-$30.00</dd>
                                 </div>--}}
                                <div class="flex justify-between">
                                    <dt class="text-lg text-neutral-600 uppercase font-mono tracking-tight">Taxes</dt>
                                    <dd class="text-neutral-500 font-mono">{{ format_money(0) }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-lg text-neutral-600 uppercase font-mono tracking-tight">Shipping</dt>
                                    <dd class="text-neutral-500 font-mono">Free</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-neutral-200 pt-6 text-neutral-500 font-mono">
                                    <dt class="text-base">Total</dt>
                                    <dd class="text-base">{{ format_money($grand_total) }}</dd>
                                </div>
                            </dl>
                        </div>
                        @if($cart_items)
                            <div class="mt-6 flex flex-col gap-2">
                                <a href="{{ auth()->check() ? route('checkout') : route('login', ['redirect' => route('checkout')]) }}"
                                   title="Checkout" aria-label="Checkout"
                                   class="relative group overflow-hidden pl-4 font-mono h-14 flex space-x-6 items-center bg-orange-500 hover:bg-black duration-300 rounded-xl w-full justify-between">
                                    <span class="relative uppercase text-xs text-white">Checkout</span>
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
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
