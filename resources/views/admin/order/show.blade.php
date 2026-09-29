<x-admin-layout>
    @php($client = $order->client)
    <div class="mx-auto max-w-6xl rounded-3xl bg-primary-100 px-4 py-8 sm:px-6 lg:px-8 dark:bg-gray-700">
        <div class="grid gap-6 lg:grid-cols-3">
            <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400 lg:col-span-2">
                <div class="flex items-center justify-between"><div><p class="text-sm text-gray-500">#{{ $order->id }}</p><h1 class="text-2xl font-semibold text-primary-700 dark:text-white">{{ __('admin.order_details') }}</h1></div><span class="rounded-full bg-primary-100 px-3 py-1">{{ __('store.status_'.$order->status) }}</span></div>
                <div class="mt-6 space-y-4">@foreach($order->orderItems as $item)<div class="flex items-center gap-4 border-b border-primary-100 pb-4 dark:border-gray-500"><img src="{{ $item->product->main_image ? asset('pictures'.$item->product->main_image) : asset('pictures/global/og-main.jpeg') }}" class="h-16 w-16 rounded-xl object-cover" alt=""><div class="flex-1"><p class="font-semibold">{{ $item->product->name_en }}</p><p class="text-sm text-gray-500">{{ __('admin.qty') }}: {{ $item->quantity }}</p></div></div>@endforeach</div>
                <div class="mt-6 space-y-2"><p>{{ __('store.subtotal') }}: {{ number_format($order->subtotal, 3) }} {{ __('store.tnd') }}</p><p>{{ __('store.delivery') }}: {{ $order->delivery == 0 ? __('store.free') : number_format($order->delivery, 3).' '.__('store.tnd') }}</p><p class="text-xl font-semibold">{{ __('store.total') }}: {{ number_format($order->total, 3) }} {{ __('store.tnd') }}</p></div>
                @if($order->message)<div class="mt-6 rounded-2xl bg-primary-100 p-4 dark:bg-gray-700"><p class="text-sm text-gray-500">{{ __('store.message') }}</p><p class="mt-2 whitespace-pre-line">{{ $order->message }}</p></div>@endif
            </div>
            <div class="space-y-6">
                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400"><h2 class="text-xl font-semibold">{{ __('admin.client_information') }}</h2><div class="mt-4 space-y-2"><p>{{ trim(($client['firstname'] ?? '').' '.($client['lastname'] ?? '')) }}</p><p>{{ $client['email'] ?? '' }}</p><p>{{ $client['phone'] ?? '' }}</p><p>{{ $client['address'] ?? '' }}, {{ $client['city'] ?? '' }}, {{ $client['state'] ?? '' }}</p></div></div>
                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400"><h2 class="text-xl font-semibold">{{ __('admin.change_status') }}</h2><form class="mt-4 flex gap-3" method="POST" action="{{ route('admin.orders.status', $order) }}">@csrf @method('PUT')<select class="form-input flex-1" name="status">@foreach(['pending','delivery','done','canceled'] as $status)<option value="{{ $status }}" @selected($order->status === $status)>{{ __('store.status_'.$status) }}</option>@endforeach</select><button class="primary-btn">{{ __('admin.save') }}</button></form></div>
            </div>
        </div>
    </div>
</x-admin-layout>
