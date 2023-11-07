<?php $lang = app()->getLocale(); ?>
<div class="rounded-3xl my-4 group shadow-md relative">
    <a href="{{ route('course.showUrl', ['url' => $course->url]) }}">
        <div class="relative">
            <img src="{{ asset($course->image) }}" alt="Slide 1" class="max-h-32 w-full rounded-t-3xl">
            <div class="group-hover:visible group-hover:translate-y-0 course-duration-band bg-primary-100 text-gray-700 dark:bg-gray-500 dark:text-primary-50 py-1 px-4 bg-opacity-70 dark:bg-opacity-70">
                    <div class="flex items-center space-x-2">
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
            <div class="group-hover:bg-primary-300 rounded-b-3xl p-4 bg-primary-150 dark:bg-gray-400 dark:group-hover:bg-gray-500">
                <p class="text-xl text-stoned-900 dark:text-primary-100 font-medium mb-4 {{$lang == 'ar' ? ('text-right') : ('')}}">
                    {{$lang == 'ar' ? $course->title_ar : $course->title_en}}
                </p>
                <div class="flex justify-between items-center">
                    <p class="text-base text-stone dark:text-primary-200">
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
<style>
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