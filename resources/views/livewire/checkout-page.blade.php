<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-mono font-bold text-gray-800 dark:text-white mb-4">
        Checkout
    </h1>
    <div class="grid grid-cols-12 gap-4">
        <div class="md:col-span-12 lg:col-span-8 col-span-12">
            <!-- Card -->
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="text-xl font-mono underline text-gray-700 dark:text-white mb-2">
                            Shipping Address
                        </h2>
                        <form wire:submit.prevent="placeOrder" class="grid grid-cols-12 gap-1">
                            <div class="col-span-full">
                                <label for="phone-number" class="sr-only">Phone number</label>
                                <div class="mt-1">
                                    <input wire:model="phone" type="tel" id="phone-number" name="phone-number" placeholder="Phone number" aria-label="Phone number" autocomplete="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full @error('phone') ring-red-500 @enderror">
                                </div>
                                @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-span-full">
                                <label for="name-on-card" class="sr-only">Name on card</label>
                                <div class="mt-1">
                                    <input wire:model="name" type="text" id="name-on-card" name="name-on-card" placeholder="Name on card" autocomplete="cc-name" aria-label="Name on card" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full @error('name') ring-red-500 @enderror">
                                </div>
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{--<div class="col-span-full">
                                <label for="card-number" class="sr-only">Card number</label>
                                <div class="mt-1">
                                    <input  type="text" id="card-number" name="card-number" autocomplete="cc-number" placeholder="Card number" aria-label="Card number" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full">
                                </div>
                            </div>--}}
                            {{--<div class="col-span-8 sm:col-span-9">
                                <label for="expiration-date" class="sr-only">Expiration date (MM/YY)</label>
                                <div class="mt-1">
                                    <input type="text" name="expiration-date" id="expiration-date" placeholder="Expiration date (MM/YY)" aria-label="Expiration date" autocomplete="cc-exp" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full">
                                </div>
                            </div>
                            <div class="col-span-4 sm:col-span-3">
                                <label for="cvc" class="sr-only">CVC</label>
                                <div class="mt-1">
                                    <input id="cvc" type="text" name="cvc" placeholder="CVC" autocomplete="cc-csc" aria-label="CVC" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full">
                                </div>
                            </div>--}}
                            <div class="col-span-full">
                                <label  for="address" class="sr-only">Address</label>
                                <div class="mt-1">
                                    <input wire:model="street_address" id="address" type="text" name="address" placeholder="Address" aria-label="Address" autocomplete="street-address" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full @error('street_address') ring-red-500 @enderror">
                                </div>
                                @error('street_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <label for="city" class="sr-only">City</label>
                                <div class="mt-1">
                                    <input wire:model="city" id="city" type="text" name="city" placeholder="City" aria-label="City" autocomplete="address-level2" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full @error('city') ring-red-500 @enderror">
                                </div>
                                @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <label for="region" class="sr-only">State / Province</label>
                                <div class="mt-1">
                                    <input  wire:model="state" id="region" type="text" name="region" placeholder="State / Province" aria-label="State / Province" autocomplete="address-level1" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full @error('state') ring-red-500 @enderror">
                                </div>
                                @error('state') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <label for="postal-code" class="sr-only">Postal code</label>
                                <div class="mt-1">
                                    <input  wire:model="zip_code" id="postal-code" type="text" name="postal-code" placeholder="Postal Code" autocomplete="postal-code" aria-label="Postal code" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full @error('zip_code') ring-red-500 @enderror">
                                </div>
                                @error('zip_code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{--<div class="col-span-full mt-2">
                                <label for="discount-code" class="sr-only">Discount code</label>
                                <div class="mt-1 flex w-full space-x-2">
                                    <input id="discount-code" type="text" name="discount-code" placeholder="Discount Code" aria-label="Discount code" class="flex-auto rounded-xl font-mono border-0 h-14 text-xs uppercase duration-300 px-3.5 py-2 text-neutral-500 ring-1 ring-inset ring-white placeholder:text-neutral-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 bg-neutral-100 w-full">
                                    <button type="submit" title="link to your page" aria-label="your label" class="relative group overflow-hidden px-6 justify-center text-xs text-white font-mono h-14 flex uppercase items-center bg-black hover:bg-neutral-200 hover:text-orange-600 duration-300 rounded-xl w-full">
                                        Apply
                                    </button>
                                </div>
                            </div>--}}
                            <div class="mt-2 flex flex-col gap-2">
                                <button  type="submit" title="link to your page" aria-label="your label" class="relative group overflow-hidden pl-4 font-mono h-14 flex space-x-6 items-center bg-orange-500 hover:bg-black duration-300 rounded-xl w-full justify-between">
                                    <span class="relative uppercase text-xs text-white">Pay</span>
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
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <!-- End Card -->
        </div>
    </div>
</div>
