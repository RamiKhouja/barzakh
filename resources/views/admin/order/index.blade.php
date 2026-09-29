<x-admin-layout>
    <div class="rounded-3xl bg-primary-100 py-8 dark:bg-gray-700">
        <div class="mx-auto max-w-7xl px-4 lg:px-8">
            <h1 class="text-2xl font-semibold text-primary-700 dark:text-white">{{ __('admin.orders_title') }}</h1>
            <div class="mt-6 overflow-x-auto rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-100">
                    <thead><tr><th class="table-th">#</th><th class="table-th">{{ __('admin.client') }}</th><th class="table-th">{{ __('admin.total') }}</th><th class="table-th">{{ __('admin.status') }}</th><th class="table-th">{{ __('admin.created') }}</th><th class="table-th"></th></tr></thead>
                    <tbody class="divide-y divide-gray-300 dark:divide-gray-100">
                        @forelse($orders as $order)
                            @php($client = $order->client)
                            <tr><td class="table-text">#{{ $order->id }}</td><td class="table-text">{{ trim(($client['firstname'] ?? '').' '.($client['lastname'] ?? '')) }}<br><span class="text-xs">{{ $client['email'] ?? '' }}</span></td><td class="table-text">{{ number_format($order->total, 3) }} {{ __('store.tnd') }}</td><td class="table-text"><span class="rounded-full bg-primary-100 px-3 py-1 text-xs font-semibold">{{ __('store.status_'.$order->status) }}</span></td><td class="table-text">{{ $order->created_at?->format('Y-m-d H:i') }}</td><td class="table-text"><a class="text-primary-700 underline dark:text-white" href="{{ route('admin.orders.show', $order) }}">{{ __('admin.view_page') }}</a></td></tr>
                        @empty<tr><td colspan="6" class="py-10 text-center text-gray-500">{{ __('admin.no_orders') }}</td></tr>@endforelse
                    </tbody>
                </table>
                <div class="mt-6">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
</x-admin-layout>
