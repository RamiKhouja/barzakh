<x-app-layout :meta_title="$meta_title" :meta_description="$meta_description" :meta_image="$meta_image" :meta_url="$meta_url">
    @php($lang = app()->getLocale())
    @php($name = $lang === 'ar' ? $product->name_ar : $product->name_en)
    @php($shortDescription = $lang === 'ar' ? $product->short_description_ar : $product->short_description_en)
    @php($description = $lang === 'ar' ? $product->description_ar : $product->description_en)
    @php($hasDiscount = $product->is_discount && $product->discount_price !== null)
    @php($isOutOfStock = $product->has_qty && $product->stock !== null && $product->stock <= 0)
    @php($isSold = (bool) $product->is_sold)
    <div class="mt-8 bg-primary-100 py-16 dark:bg-gray-700 md:mt-0" dir="{{ $lang === 'ar' ? 'rtl' : 'ltr' }}">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-2">
                <div>
                    <div class="relative overflow-hidden rounded-3xl bg-primary-150 shadow-lg dark:bg-gray-400">
                        @if($isSold)<span class="absolute left-4 top-4 z-10 rounded-full bg-bordo px-3 py-1 text-sm font-semibold text-white">{{ __('store.sold') }}</span>
                        @elseif($isOutOfStock)<span class="absolute left-4 top-4 z-10 rounded-full bg-bordo px-3 py-1 text-sm font-semibold text-white">{{ __('store.out_of_stock') }}</span>@endif
                        <img id="product-main-image" src="{{ $product->main_image ? asset('pictures'.$product->main_image) : asset('pictures/global/og-main.jpeg') }}" alt="{{ $name }}" class="h-[22rem] w-full object-cover sm:h-[30rem]">
                    </div>
                    @if($product->pictures->isNotEmpty())
                        <div class="mt-4 flex gap-3 overflow-x-auto pb-2">
                            @if($product->main_image)<button type="button" onclick="changeProductImage(this.dataset.image)" data-image="{{ asset('pictures'.$product->main_image) }}"><img src="{{ asset('pictures'.$product->main_image) }}" class="h-20 w-24 rounded-xl object-cover ring-2 ring-bordo " alt=""></button>@endif
                            @foreach($product->pictures as $picture)<button type="button" onclick="changeProductImage(this.dataset.image)" data-image="{{ asset('pictures'.$picture->picture) }}"><img src="{{ asset('pictures'.$picture->picture) }}" class="h-20 w-24 rounded-xl object-cover" alt=""></button>@endforeach
                        </div>
                    @endif
                </div>
                <div class="flex flex-col lg:mt-8">
                    <div class="mb-4 flex flex-wrap gap-2">@foreach($product->categories as $category)<span class="rounded-full bg-primary-200 px-3 py-1 text-sm text-primary-700 dark:bg-gray-400 dark:text-white">{{ $lang === 'ar' ? $category->title_ar : $category->title_en }}</span>@endforeach</div>
                    <h1 class="text-4xl font-semibold text-primary-700 dark:text-white">{{ $name }}</h1>
                    @if($shortDescription)<p class="mt-5 text-lg leading-8 text-stone dark:text-primary-100">{{ $shortDescription }}</p>@endif
                    <div class="mt-8 flex items-center gap-3 text-2xl font-semibold text-bordo dark:text-white">
                        @if($product->is_free){{ __('store.free') }}@else @if($hasDiscount)<span class="text-lg text-gray-500 line-through dark:text-gray-200">{{ rtrim(rtrim(number_format((float) $product->price, 3), '0'), '.') }} {{ __('store.tnd') }}</span>@endif{{ rtrim(rtrim(number_format((float) ($hasDiscount ? $product->discount_price : $product->price), 3), '0'), '.') }} {{ __('store.tnd') }}@endif
                    </div>
                    @include('client.partials.product-cart-controls')
                </div>
            </div>
            @if($description)<section class="prose prose-lg mt-16 max-w-none rounded-3xl bg-primary-150 p-6 text-stone dark:text-white dark:prose-invert dark:bg-gray-400 sm:p-10" dir="{{ $lang === 'ar' ? 'rtl' : 'ltr' }}">{!! $description !!}</section>@endif
            @if($youtubeVideos->isNotEmpty())<section class="mt-16"><h2 class="mb-6 text-3xl font-semibold text-primary-700 dark:text-white">{{ __('store.videos') }}</h2><div class="grid gap-6 md:grid-cols-2">@foreach($youtubeVideos as $video)<div class="aspect-video overflow-hidden rounded-2xl shadow"><iframe src="{{ $video }}" class="h-full w-full" title="{{ $name }}" allowfullscreen></iframe></div>@endforeach</div></section>@endif
            @if($product->audios->isNotEmpty())<section class="mt-12"><h2 class="mb-6 text-3xl font-semibold text-primary-700 dark:text-white">{{ __('store.audio') }}</h2><div class="space-y-4">@foreach($product->audios as $audio)<audio controls class="w-full"><source src="{{ asset('pictures'.$audio->audio_path) }}"></audio>@endforeach</div></section>@endif
            @if($relatedProducts->isNotEmpty())<section class="mt-20"><h2 class="mb-8 text-3xl font-semibold text-primary-700 dark:text-white">{{ __('store.related') }}</h2><div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">@foreach($relatedProducts as $related)<x-product :product="$related" />@endforeach</div></section>@endif
        </div>
    </div>
    <script>function changeProductImage(image){document.getElementById('product-main-image').src=image;}</script>
</x-app-layout>
