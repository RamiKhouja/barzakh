<x-app-layout>
    @php($lang = app()->getLocale())
    @php($isRtl = $lang === 'ar')
    <div class="bg-primary-100 py-16 dark:bg-gray-700" dir="{{ $isRtl ? 'rtl' : 'ltr' }}" x-data="checkoutPage()">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <h1 class="mb-8 text-3xl font-semibold text-primary-700 dark:text-white">{{ __('store.checkout') }}</h1>
            <form method="POST" action="{{ route('orders.store') }}" @submit="prepareSubmit" class="grid gap-8 lg:grid-cols-3">
                @csrf
                <input type="hidden" name="language" value="{{ in_array($lang, ['en', 'ar', 'fr']) ? $lang : 'en' }}">
                <input type="hidden" name="payment_method" value="cash">
                <input type="hidden" name="items" x-ref="itemsInput">
                <div class="space-y-6 lg:col-span-2">
                    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                        <h2 class="text-xl font-semibold text-primary-700 dark:text-white">{{ __('store.order_items') }}</h2>
                        <div x-show="!items.length" class="py-10 text-center text-gray-500 dark:text-gray-100">{{ __('store.empty_cart') }}</div>
                        <div class="mt-5 space-y-4">
                            <template x-for="item in items" :key="item.id">
                                <div class="flex items-center gap-4 border-b border-primary-100 pb-4 dark:border-gray-500">
                                    <img :src="item.image" class="h-16 w-16 rounded-xl object-cover" alt="">
                                    <div class="min-w-0 flex-1"><p class="truncate font-semibold text-primary-700 dark:text-white" x-text="item.name_{{ $lang === 'ar' ? 'ar' : 'en' }} || item.name"></p><p class="text-sm text-gray-500 dark:text-gray-200" x-text="format(item.price) + ' {{ __('store.tnd') }}'"></p></div>
                                    <div class="flex items-center gap-2" x-show="item.has_qty"><button type="button" @click="change(item, -1)" :disabled="item.quantity <= 1" class="rounded-full bg-primary-100 px-3 py-1 disabled:opacity-40">−</button><span class="text-gray-700 dark:text-gray-100" x-text="item.quantity"></span><button type="button" @click="change(item, 1)" :disabled="item.stock !== null && item.quantity >= item.stock" class="rounded-full bg-primary-100 px-3 py-1 disabled:opacity-40">+</button></div>
                                    <span x-show="!item.has_qty">1</span>
                                    <button type="button" @click="remove(item.id)" class="text-sm text-red-600">{{ __('store.remove') }}</button>
                                </div>
                            </template>
                        </div>
                    </section>
                    <section class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                        <h2 class="text-xl font-semibold text-primary-700 dark:text-white">{{ __('store.client_information') }}</h2>
                        <div class="mt-5 grid gap-4 md:grid-cols-2">
                            <input class="form-input" name="firstname" required placeholder="{{ __('store.firstname') }}" value="{{ old('firstname', $user?->firstname) }}">
                            <input class="form-input" name="lastname" placeholder="{{ __('store.lastname') }}" value="{{ old('lastname', $user?->lastname) }}">
                            <input class="form-input" type="email" name="email" required placeholder="{{ __('store.email') }}" value="{{ old('email', $user?->email) }}">
                            <input class="form-input" name="phone" required placeholder="{{ __('store.phone') }}" value="{{ old('phone', $user?->phone) }}">
                            <input class="form-input" name="country" value="Tunisia" disabled>
                            <input type="hidden" name="country" value="Tunisia">
                            <div class="relative"><select class="form-input w-full {{ $isRtl ? 'appearance-none pl-10' : '' }}" style="{{ $isRtl ? 'appearance: none; -webkit-appearance: none; background-image: none;' : '' }}" name="state" required>
                                <option value="">{{ __('store.select_state') }}</option>
                                @foreach($states as $state)<option value="{{ $isRtl ? $state['ar'] : $state['en'] }}" @selected(old('state') === ($isRtl ? $state['ar'] : $state['en']))>{{ $isRtl ? $state['ar'] : $state['en'] }}</option>@endforeach
                            </select>
                                @if($isRtl)<span class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-primary-700">⌄</span>@endif
                            </div>
                            <input class="form-input" name="city" required placeholder="{{ __('store.city') }}" value="{{ old('city', $user?->city) }}">
                            <input class="form-input" name="zip_code" placeholder="{{ __('store.zip_code') }}" value="{{ old('zip_code', $user?->zip_code) }}">
                            <textarea class="form-input md:col-span-2" name="address" required placeholder="{{ __('store.address') }}">{{ old('address', $user?->address) }}</textarea>
                            <textarea class="form-input md:col-span-2" name="message" placeholder="{{ __('store.message') }}">{{ old('message') }}</textarea>
                        </div>
                    </section>
                </div>
                <aside class="h-fit rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <h2 class="text-xl font-semibold text-primary-700 dark:text-white">{{ __('store.summary') }}</h2>
                    <div class="mt-6 space-y-3 text-gray-700 dark:text-gray-100"><div class="flex justify-between"><span>{{ __('store.subtotal') }}</span><span x-text="format(subtotal) + ' {{ __('store.tnd') }}'"></span></div><div class="flex justify-between"><span>{{ __('store.delivery') }}</span><span x-text="delivery === 0 ? '{{ __('store.free') }}' : format(delivery) + ' {{ __('store.tnd') }}'"></span></div><p class="text-xs text-gray-500 dark:text-gray-300">{{ __('store.free_delivery_note') }}</p><div class="flex justify-between border-t border-primary-100 pt-3 text-lg font-semibold"><span>{{ __('store.total') }}</span><span x-text="format(total) + ' {{ __('store.tnd') }}'"></span></div></div>
                    <div class="mt-6 rounded-2xl bg-primary-100 p-4 dark:bg-gray-700"><label class="flex items-center gap-3"><input type="radio" checked disabled><span class="font-medium dark:text-gray-100">{{ __('store.cash_on_delivery') }}</span></label></div>
                    <button type="submit" :disabled="!items.length" class="primary-btn mt-6 w-full disabled:cursor-not-allowed disabled:opacity-50">{{ __('store.purchase') }}</button>
                </aside>
            </form>
        </div>
    </div>
    <script>
        function checkoutPage() { return { items: [], init() { this.items = barzakhCart.get(); barzakhCart.hydrate().then(() => this.items = barzakhCart.get()); }, change(item, delta) { barzakhCart.update(item.id, item.quantity + delta); this.items = barzakhCart.get(); }, remove(id) { barzakhCart.remove(id); this.items = barzakhCart.get(); }, get subtotal() { return this.items.reduce((s, i) => s + i.price * i.quantity, 0); }, get delivery() { return this.subtotal >= 300 ? 0 : 8; }, get total() { return this.subtotal + this.delivery; }, format(value) { return Number(value).toFixed(3); }, prepareSubmit() { this.$refs.itemsInput.value = JSON.stringify(this.items.map(i => ({ product_id: i.id, quantity: i.has_qty ? i.quantity : 1 }))); barzakhCart.clear(); } }; }
    </script>
</x-app-layout>
