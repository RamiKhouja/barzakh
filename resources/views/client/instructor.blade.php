<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-36">
            <div class="flex justify-between my-10 {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                    <img src="{{asset($instructor->image)}}" class="rounded-full w-32 h-32" alt="">
                    <div class="{{$lang == 'ar' ? ('text-right mr-8') : ('ml-8')}}">
                        <p class="font-bold text-3xl text-gray-700 dark:text-white mb-4">{{$instructor->firstname}} {{$instructor->lastname}}</p>
                        <p class="font-medium text-base text-gray-400 dark:text-gray-50 mb-4">{{$instructor->short_desc}}</p>
                        <div class="flex {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}" >
                            @if($instructor->linkedin)
                            <a href="{{$instructor->linkedin}}" target="_blank" class="social-icon {{$lang == 'ar' ? ('ml-4') : ('mr-4')}}">
                                <x-bi-linkedin class="h-5 w-5"/>
                            </a>
                            @endif
                            @if($instructor->youtube)
                            <a href="{{$instructor->youtube}}" target="_blank" class="social-icon {{$lang == 'ar' ? ('ml-4') : ('mr-4')}}">
                                <x-bi-youtube class="h-5 w-5"/>
                            </a>
                            @endif
                            @if($instructor->instagram)
                            <a href="{{$instructor->instagram}}" target="_blank" class="social-icon {{$lang == 'ar' ? ('ml-4') : ('mr-4')}}">
                                <x-bi-instagram class="h-5 w-5"/>
                            </a>
                            @endif
                            @if($instructor->twitter)
                            <a href="{{$instructor->twitter}}" target="_blank" class="social-icon {{$lang == 'ar' ? ('ml-4') : ('mr-4')}}">
                                <x-bi-twitter class="h-5 w-5"/>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="py-4 px-8 flex flex-col justify-around bg-primary-200 dark:bg-gray-400 rounded-lg text-gray-400 dark:text-white">
                    <div class="flex items-center justify-between {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                        <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                            <x-heroicon-s-play-circle class="h-5 w-5"/>
                            <p class="text-lg {{$lang == 'ar' ? ('mr-2 ml-8') : ('mr-8 ml-2')}}">{{__('instructor.courses')}}</p>
                        </div>
                        <p class="text-lg">{{$instructor->nb_courses}}</p>
                    </div>
                    <div class="flex items-center justify-between {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                        <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                            <x-heroicon-s-academic-cap class="h-5 w-5"/>
                            <p class="text-lg {{$lang == 'ar' ? ('mr-2 ml-8') : ('mr-8 ml-2')}}">{{__('instructor.students')}}</p>
                        </div>
                        <p class="text-lg">{{$instructor->nb_students}}</p>
                    </div>
                </div>
            </div>
            <div class="my-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-2xl {{$lang == 'ar' ? ('font-medium') : ('font-semibold')}} text-gray-700 dark:text-white">{{__('instructor.about-instructor')}}</p>
                <p class="text-gray-700 dark:text-gray-50 mt-6">{{$instructor->description}}</p>
            </div>
            <div class="my-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-2xl {{$lang == 'ar' ? ('font-medium') : ('font-semibold')}} text-gray-700 dark:text-white mb-6">{{__('instructor.the-courses')}}</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 container" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                    @foreach($instructor->courses as $course)
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