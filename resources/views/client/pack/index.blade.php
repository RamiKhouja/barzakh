<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl mx-auto mt-8 md:-mt-20 mb-72">
            <div class="flex justify-center md:mt-20 mb-20">
                <p class="text-lg md:text-xl lg:text-3xl text-primary-600 dark:text-white font-bold">{{__('welcome.our-packs')}}</p>
            </div>
            <div class="sm:grid sm:gap-16 sm:grid-cols-2">
            @foreach($packs as $pack)
                <div class="w-full shadow rounded-3xl bg-primary-150 dark:bg-stone p-8 mb-8 md:mb-0 {{$lang=='ar' ? ('text-right'):('')}} flex flex-col justify-between">
                    <div>
                        <p class="text-lg md:text-xl lg:text-2xl mb-4 text-gray-700 dark:text-white font-black {{$lang=='ar' ? (''):('italic')}}">
                            {{$pack->name}}
                        </p>
                        <p class="text-sm md:text-base text-gray-500 dark:text-primary-50 {{$lang=='ar' ? ('text-right'):('')}}" dir="{{$lang=='ar' ? ('rtl'):('ltr')}}">
                            {{$pack->description}}
                        </p>
                        <p class="my-4 flex items-baseline gap-x-2 " dir="{{$lang=='ar' ? ('rtl'):('ltr')}}">
                            <span class="text-4xl font-bold tracking-tight text-bordo dark:text-red-500">${{$pack->price}}</span>
                            <span class="text-base leading-6 text-gray-400 dark:text-primary-150">{{__('pack.instead-of')}}</span>
                            <span class="text-lg font-medium leading-6 text-gray-400 dark:text-primary-150">${{$pack->orig_price}}</span>
                        </p>
                        <p class="text-sm md:text-base text-gray-500 dark:text-primary-50 {{$lang=='ar' ? ('text-right'):('')}}">
                            {{__('pack.this-pack-contains')}}
                        </p>
                        <div class="mt-2 {{$lang=='ar' ? ('mr-6'):('ml-6')}}">
                            @foreach($pack->courses as $course)
                            <div class="flex gap-x-2 items-center mb-2" dir="{{$lang=='ar' ? ('rtl'):('ltr')}}">
                                <x-heroicon-s-academic-cap class="text-bordo w-4 h-4 dark:text-red-500"/>
                                <a href="{{route('course.showUrl',['url'=>$course->url])}}" class="text-sm md:text-base text-gray-500 dark:text-primary-50 hover:text-bordo dark:hover:text-red-500">
                                    {{$lang=='ar' ? ($course->title_ar):($course->title_en)}}
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-6">
                        <button class="w-full bg-bordo dark:bg-red-500 text-white text-center text-lg py-1.5 rounded-xl hover:shadow hover:bg-primary-600 dark:hover:bg-red-700">
                            {{__('pack.get-pack')}}
                        </button>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <x-footer/>
    </div>
</x-app-layout>