@props(['product'])
@php($lang = app()->getLocale())
@php($name = $lang === 'ar' ? $product->name_ar : $product->name_en)
@php($shortDescription = $lang === 'ar' ? $product->short_description_ar : $product->short_description_en)
@php($hasDiscount = $product->is_discount && $product->discount_price !== null)
@php($currentPrice = $hasDiscount ? $product->discount_price : $product->price)

<article class="group flex h-full flex-col overflow-hidden rounded-3xl bg-primary-150 shadow-md transition hover:-translate-y-1 hover:shadow-xl dark:bg-gray-400" dir="{{ $lang === 'ar' ? 'rtl' : 'ltr' }}">
    <a href="{{ route('product.showUrl', ['url' => $product->url]) }}" class="block">
        <div class="relative h-48 overflow-hidden">
            <img src="{{ $product->main_image ? asset('pictures'.$product->main_image) : asset('pictures/global/og-main.jpeg') }}" alt="{{ $name }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
            @if($product->is_new)<span class="absolute top-3 {{ $lang === 'ar' ? 'right-3' : 'left-3' }} rounded-full bg-bordo px-3 py-1 text-xs font-semibold text-white">{{ __('store.new') }}</span>@endif
        </div>
    </a>
    <div class="flex flex-1 flex-col p-5">
        <a href="{{ route('product.showUrl', ['url' => $product->url]) }}" class="block">
            <h2 class="line-clamp-2 text-xl font-semibold text-stoned-900 dark:text-primary-100">{{ $name }}</h2>
            <p class="mt-3 line-clamp-3 min-h-[4.5rem] text-sm leading-6 text-stone dark:text-primary-100">{{ $shortDescription }}</p>
        </a>
        <div class="mt-auto flex items-center justify-between gap-3 pt-5">
            <div class="text-lg font-semibold text-bordo dark:text-white">
                @if($product->is_free)<span>{{ __('store.free') }}</span>@else
                    @if($hasDiscount)<span class="mr-2 text-sm text-gray-500 line-through dark:text-gray-200">{{ rtrim(rtrim(number_format((float) $product->price, 3), '0'), '.') }} {{ __('store.tnd') }}</span>@endif
                    <span>{{ rtrim(rtrim(number_format((float) $currentPrice, 3), '0'), '.') }} {{ __('store.tnd') }}</span>
                @endif
            </div>
        </div>
    </div>
</article>
