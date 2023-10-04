<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl mx-auto mt-8 md:-mt-20 mb-72">
            <div class="flex justify-center md:mt-20 mb-20">
                <p class="text-lg md:text-xl lg:text-3xl text-primary-700 font-bold">{{ $field->title }}</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 sm:gap-20" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                @foreach($field->categories as $category)
                <a href="{{ route('category.showUrl', ['url' => $category->url]) }}">
                    <div class="group relative mb-20 sm:mb-0">
                        <div class="rounded-xl group">
                            <img src="{{ asset($category->image) }}" alt="Slide 1" class="rounded-t-xl group-hover:rounded-b-xl">
                            <div class="field-details field-det-hov rounded-b-xl p-6 bg-stone">
                                <p class="text-xl text-gray-50 font-semibold text-center">
                                    {{$lang == 'ar' ? $category->title_ar : $category->title_en}}
                                </p>
                                <p class="text-base text-gray-100 text-center mt-4 hidden group-hover:block">
                                    {{$lang == 'ar' ? $category->description_ar : $category->description_en}}
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
        top: 60%;
        height: 40%;
        width: 100%;
        transform: translateY(100%);
        transition: transform .25s linear;
    }
</style>