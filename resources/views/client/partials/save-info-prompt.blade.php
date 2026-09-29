@if(!$order->user_id && session('order_created'))
    <div x-data="{ open: true, choosing: false }" x-show="open" x-cloak class="fixed inset-0 z-[70] flex items-start justify-center bg-black/40 px-4 pt-24" @click.self="open = false">
        <div class="w-full max-w-lg rounded-2xl bg-white p-5 shadow-2xl dark:bg-gray-400">
            <div x-show="!choosing">
                <p class="font-semibold text-primary-700 dark:text-white">{{ __('store.save_information_prompt') }}</p>
                <div class="mt-5 flex flex-wrap gap-3">
                    <button type="button" @click="choosing = true" class="primary-btn">{{ __('store.yes') }}</button>
                    <button type="button" @click="open = false" class="secondary-btn">{{ __('store.no_thanks') }}</button>
                </div>
            </div>

            <div x-show="choosing">
                <p class="font-semibold text-primary-700 dark:text-white">{{ __('store.choose_password') }}</p>
                <form method="POST" action="{{ route('orders.save-info', $order->public_token) }}" class="mt-4 space-y-3">
                    @csrf
                    <input class="form-input" type="password" name="password" required placeholder="{{ __('store.password') }}">
                    <input class="form-input" type="password" name="password_confirmation" required placeholder="{{ __('store.confirm_password') }}">
                    <div class="flex flex-wrap gap-3">
                        <button class="primary-btn" type="submit">{{ __('store.save_information') }}</button>
                        <button class="secondary-btn" type="button" @click="choosing = false">{{ __('store.cancel') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
