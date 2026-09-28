<x-admin-layout>
    @php($isRtl = app()->getLocale() === 'ar')
    <div class="bg-primary-100 py-12 dark:bg-gray-700">
        <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
            @if(session('success'))<div class="mb-6 rounded-md bg-green-50 p-4 text-green-700" id="successMessage" role="alert">{{ session('success') }}</div>@endif
            <div class="mb-10 flex items-center justify-between gap-4">
                <div><h1 class="text-2xl font-semibold text-primary-700 dark:text-white">{{ __('admin.products_title') }}</h1><p class="mt-2 text-gray-600 dark:text-gray-100">{{ __('admin.products_description') }}</p></div>
                <a href="{{ route('admin.product.create') }}" class="primary-btn">+ {{ __('admin.new_product') }}</a>
            </div>
            <div class="overflow-x-auto rounded-2xl bg-white shadow-sm dark:bg-gray-400">
                <table dir="{{ $isRtl ? 'rtl' : 'ltr' }}" class="min-w-full divide-y divide-gray-300 dark:divide-gray-100"><thead><tr><th class="table-th {{ $isRtl ? 'text-right' : 'text-left' }}">{{ __('admin.main_image') }}</th><th class="table-th {{ $isRtl ? 'text-right' : 'text-left' }}">{{ __('admin.product_name') }}</th><th class="table-th {{ $isRtl ? 'text-right' : 'text-left' }}">{{ __('admin.price') }}</th><th class="table-th {{ $isRtl ? 'text-right' : 'text-left' }}">{{ __('admin.categories') }}</th><th class="table-th {{ $isRtl ? 'text-right' : 'text-left' }}">{{ __('admin.status') }}</th><th class="table-th {{ $isRtl ? 'text-right' : 'text-left' }}">{{ __('admin.actions') }}</th></tr></thead><tbody class="divide-y divide-gray-300 dark:divide-gray-100">
                @forelse($products as $product)<tr><td class="px-4 py-3">@if($product->main_image)<img src="{{ asset('pictures' . $product->main_image) }}" class="h-12 w-16 rounded object-cover" alt="">@endif</td><td class="table-text"><div>{{ $product->name_en }}</div><div dir="rtl">{{ $product->name_ar }}</div></td><td class="table-text">{{ number_format($product->price, 3) }}</td><td class="table-text">{{ $product->categories->pluck('title_en')->join(', ') }}</td><td class="table-text">{{ $product->show && $product->is_active ? __('admin.visible') : __('admin.hidden') }}</td><td class="px-4 py-3 align-middle"><div class="flex items-center justify-center gap-3"><a href="{{ route('admin.product.edit', $product) }}" class="inline-flex text-primary-500"><x-zondicon-edit-pencil class="h-4 w-4" /></a><form action="{{ route('admin.product.delete', $product) }}" method="POST" class="inline-flex" onsubmit="return confirm('{{ __('admin.delete_product_confirmation') }}')">@csrf @method('DELETE')<button type="submit"><x-zondicon-trash class="h-4 w-4 text-gray-400" /></button></form></div></td></tr>@empty<tr><td colspan="6" class="px-4 py-10 text-center text-gray-500">{{ __('admin.no_products') }}</td></tr>@endforelse
                </tbody></table>
            </div>
            <div class="mt-8">{{ $products->links() }}</div>
        </div>
    </div>
</x-admin-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successMessage = document.getElementById('successMessage');

        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = 'opacity 300ms ease';
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.remove(), 300);
            }, 3000);
        }
    });
</script>
