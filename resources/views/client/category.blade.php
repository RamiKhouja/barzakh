<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-36">
            <div class="flex {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}  md:mt-20 mb-20">
                <p class="text-sm md:text-base lg:text-lg">
                    <a href="{{ route('fields.showUrl', ['url' => $category->field->url]) }}" 
                        class="text-gray-400 hover:text-gray-700 dark:text-gray-50 dark:hover:text-white"
                    >
                        {{$category->field->title}}
                    </a>
                </p>
                @if($lang == 'ar') 
                <x-heroicon-s-chevron-left class="w-4 mx-2 dark:text-white"/>
                @else
                <x-heroicon-s-chevron-right class="w-4 mx-2 dark:text-white" />
                @endif
                    
                <p class="text-sm md:text-base lg:text-lg text-gray-700 dark:text-white font-semibold">
                    {{$lang == 'ar' ? $category->title_ar : $category->title_en}}
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 container" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                @foreach($courses as $course)
                
                <div class="rounded-3xl group ">
                <a href="{{ route('course.showUrl', ['url' => $course->url]) }}">
                    <div class="relative">
                        <img src="{{ asset($course->image) }}" alt="Slide 1" class="max-h-32 w-full rounded-t-3xl">
                        <div class="group-hover:visible group-hover:translate-y-0 course-duration-band bg-stone text-white py-1 px-4 bg-opacity-70">
                                <div class="flex items-center space-x-2 {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                                    <x-heroicon-o-clock class="w-4 h-4"/>
                                    <p class="text-sm font-semibold">
                                        <?php
                                            $hours = floor($course->duration / 3600);
                                            $minutes = floor(($course->duration % 3600) / 60);
                                            $seconds = $course->duration % 60;
                                        ?>
                                        {{$hours>0 ? ($hours==1 ? (__('welcome.1h').' ') : ($hours.__('welcome.h').' ')): ('')}}
                                        {{$minutes>0 ? ($minutes==1 ? __('welcome.1m') : ($minutes.__('welcome.m'))): ('')}}
                                    </p> 
                                    <p class="text-sm font-black">|</p>
                                    <p class="text-sm font-semibold">
                                        {{$course->nb_lessons> 0 ? ($course->nb_lessons==1 ? __('welcome.1Lesson') : ($course->nb_lessons.' '.__('welcome.Lessons'))): __('welcome.No-Lessons')}}
                                    </p>
                                </div>
                        </div>
                        <div class="group-hover:bg-gray-400 rounded-b-3xl p-4 bg-stone">
                            <p class="text-xl text-gray-50 font-semibold mb-4 {{$lang == 'ar' ? ('text-right') : ('')}}">
                                {{$lang == 'ar' ? $course->title_ar : $course->title_en}}
                            </p>
                            <div class="flex justify-between items-center">
                                <p class="text-base text-gray-200">
                                    {{$course->instructor->firstname}} {{$course->instructor->lastname}}
                                </p>
                                <a href="/prd" class="text-gray-50 z-50 px-1.5 py-1 border border-gray-50 rounded-full bg-gray-400">
                                <x-heroicon-s-bookmark  class="h-6 w-5"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </a>
                </div>
                @endforeach
            </div>
            <div class="pagination mt-20">
                {{ $courses->links() }}
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
    .course-duration-band {
        position: absolute;
        visibility: hidden;
        top: 100px;
        height: 28px;
        width: 100%;
        transform: translateY(100%);
        transition: transform .25s linear;
    }
    p.text-sm.text-gray-700.leading-5 {
        display: none;
    }
</style>