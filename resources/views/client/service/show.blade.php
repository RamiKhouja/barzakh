<x-app-layout>
    @php $lang = app()->getLocale(); @endphp

    <div class="bg-primary-100 dark:bg-gray-700 pt-24 pb-20">
        <div class="max-w-xs sm:max-w-sm md:max-w-2xl lg:max-w-5xl mx-auto px-4">
            <div class="rounded-3xl overflow-hidden bg-white dark:bg-gray-400 shadow-lg">
                @if ($service->image)
                    <img src="{{ asset('pictures/'.$service->image) }}" alt="{{ $lang == 'ar' ? $service->title_ar : $service->title_en }}" class="w-full h-80 object-cover">
                @endif

                <div class="p-8">
                    <p class="text-3xl lg:text-4xl font-semibold text-primary-700 dark:text-white">
                        {{ $lang == 'ar' ? $service->title_ar : $service->title_en }}
                    </p>
                    <p class="text-xl text-bordo dark:text-primary-100 mt-4">
                        ${{ number_format((float) $service->price, 2) }}
                    </p>
                    <div class="wysiwyg-content mt-6 text-base lg:text-lg text-gray-700 dark:text-primary-100" dir="{{ $lang == 'ar' ? 'rtl' : 'ltr' }}">
                        {!! $lang == 'ar' ? ($service->description_ar ?? '') : ($service->description_en ?? '') !!}
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('services') }}" class="secondary-btn">{{ __('nav.Services') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
