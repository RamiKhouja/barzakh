<x-app-layout>
    @php($client = $order->client)
    <div class="bg-primary-100 py-16 dark:bg-gray-700" dir="{{ $order->language === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            @if(session('order_created'))<div class="mb-6 rounded-2xl bg-green-50 p-5 text-green-800">{{ __('store.order_created') }} {{ __('store.merchant_notified') }}</div>@endif
            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400 sm:p-10">
                <div class="flex flex-wrap items-start justify-between gap-4"><div><p class="text-sm text-gray-500">{{ __('store.order') }} #{{ $order->id }}</p><h1 class="mt-2 text-3xl font-semibold text-primary-700 dark:text-white">{{ __('store.order_details') }}</h1></div><span class="rounded-full bg-primary-100 px-4 py-2 font-semibold text-primary-700 dark:bg-gray-700 dark:text-white">{{ __('store.status_'.$order->status) }}</span></div>
                <div class="mt-8 space-y-4">@foreach($order->orderItems as $item)<div class="flex items-center gap-4 border-b border-primary-100 pb-4 dark:border-gray-500"><img src="{{ $item->product->main_image ? asset('pictures'.$item->product->main_image) : asset('pictures/global/og-main.jpeg') }}" class="h-16 w-16 rounded-xl object-cover" alt=""><div class="flex-1"><p class="font-semibold text-primary-700 dark:text-white">{{ $order->language === 'ar' ? $item->product->name_ar : $item->product->name_en }}</p><p class="text-sm text-gray-500">{{ $item->quantity }} × {{ number_format((float) ($item->product->is_discount && $item->product->discount_price !== null ? $item->product->discount_price : $item->product->price), 3) }} {{ __('store.tnd') }}</p></div></div>@endforeach</div>
                <div class="mt-8 space-y-2 text-gray-700 dark:text-gray-100"><p>{{ __('store.subtotal') }}: {{ number_format($order->subtotal, 3) }} {{ __('store.tnd') }}</p><p>{{ __('store.delivery') }}: {{ $order->delivery == 0 ? __('store.free') : number_format($order->delivery, 3).' '.__('store.tnd') }}</p><p class="text-xl font-semibold">{{ __('store.total') }}: {{ number_format($order->total, 3) }} {{ __('store.tnd') }}</p></div>
                <div class="mt-8 rounded-2xl bg-primary-100 p-5 dark:bg-gray-700"><h2 class="font-semibold text-primary-700 dark:text-white">{{ __('store.client_information') }}</h2><p class="mt-3">{{ trim(($client['firstname'] ?? '').' '.($client['lastname'] ?? '')) }}</p><p>{{ $client['email'] ?? '' }} · {{ $client['phone'] ?? '' }}</p><p>{{ $client['address'] ?? '' }}, {{ $client['city'] ?? '' }}, {{ $client['state'] ?? '' }}</p></div>
                @include('client.partials.save-info-prompt')
            </div>
        </div>
    </div>
</x-app-layout>
