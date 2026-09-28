<x-app-layout :meta_title="$meta_title" :meta_description="$meta_description" :meta_image="$meta_image" :meta_url="$meta_url">
    @php($lang = app()->getLocale())
    <div class="bg-primary-100 py-16 dark:bg-gray-700" dir="{{ $lang === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <h1 class="text-4xl font-semibold text-primary-700 dark:text-white">{{ __('store.title') }}</h1>
                <p class="mx-auto mt-3 max-w-2xl text-lg text-stone dark:text-primary-100">{{ __('store.description') }}</p>
            </div>
            <div class="mb-10 flex flex-wrap justify-center gap-3">
                <a href="{{ route('products') }}" class="rounded-full border px-5 py-2 text-sm font-semibold {{ !request('category') ? 'border-bordo bg-bordo text-white' : 'border-bordo text-bordo dark:border-white dark:text-white dark:hover:border-bordo hover:bg-bordo hover:text-white' }}">{{ __('store.all_categories') }}</a>
                @foreach($categories as $category)
                    <a href="{{ route('products', ['category' => $category->id]) }}" class="rounded-full border px-5 py-2 text-sm font-semibold {{ (int) request('category') === $category->id ? 'border-bordo bg-bordo text-white' : 'border-bordo text-bordo dark:border-white dark:text-white dark:hover:border-bordo hover:bg-bordo hover:text-white' }}">{{ $lang === 'ar' ? $category->title_ar : $category->title_en }}</a>
                @endforeach
            </div>
            @if($products->isEmpty())
                <p class="py-20 text-center text-lg text-stone dark:text-primary-100">{{ __('store.no_products') }}</p>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($products as $product)<x-product :product="$product" />@endforeach
                </div>
                <div class="mt-10">{{ $products->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
