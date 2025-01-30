<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl mx-auto mt-8 md:-mt-20 mb-72">
            <div class="flex justify-center md:mt-20 {{$lang=='ar'?('mb-6'):('mb-2')}}">
                <p class="text-lg md:text-xl lg:text-3xl text-bordo dark:text-white font-bold" style="font-family:{{$lang=='ar' ? ('TajNastaleeq') : ('Great Vibes')}}">{{ $field->title }}</p>
            </div>
            <div class="flex justify-center mb-20">
                <p class="text-sm md:text-base lg:text-xl text-primary-700 dark:text-white font-normal {{$lang=='ar'?(''):('italic')}}">{{ $field->subtitle }}</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-20" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                @foreach($field->categories as $category)
                <a href="{{ route('category.showUrl', ['url' => $category->url]) }}">
                    <div class="relative rmb-20 sm:mb-0 shadow hover:shadow-lg rounded-3xl">
                        <img class="rounded-3xl" src="{{ asset( 'pictures/'.$category->image ) }}" alt="">
                        <div class="rounded-b-3xl absolute w-full h-1/2 top-1/2 bg-gradient-to-t from-stone via-transparent to-transparent text-white py-4 px-3">
                            <div class="flex h-full items-end justify-center">
                                <p class="{{$lang == 'ar' ? ('text-xl font-semibold') : ('text-base lg:text-lg font-semibold')}}">
                                {{$lang == 'ar' ? $category->title_ar : $category->title_en}}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <x-footer/>
    </div>
</x-app-layout>
<style>
    .field-details {
        position: absolute;
        width: 100%;
    }
</style>
