<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-screen-sm lg:max-w-4xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-56">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-10 container mt-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="col-span-2">
                    <div class="iframe-container rounded-xl h-[150px] sm:h-[298px] md:h-[298px] lg:h-[274px] xl:h-[313px]">
                        <div id="video-placeholder" class="w-full h-full">
                            <img src="{{ asset('/pictures/vid-placeholder.png') }}" alt="Video Placeholder" class="w-full h-full object-cover">
                        </div>
                        <iframe 
                            id="vimeo-frame" 
                            class="responsive-iframe -mt-6"
                            src="https://player.vimeo.com/video/{{$course->featured_vid}}?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" 
                            frameborder="0" allow="autoplay; fullscreen;" 
                            title="{{$course->title_en}}" onload="showVideoFrame()">
                        </iframe>
                    </div>
                </div>
                <div class="px-4 sm:max-w-sm lg:max-w-lg" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                    <div>
                        <p class="text-2xl text-gray-700 dark:text-white {{$lang == 'ar' ? ('font-medium') : ('font-semibold')}} mb-4">
                            {{$lang == 'ar' ? ($course->title_ar) : ($course->title_en)}}
                        </p>
                        <div class="flex justify-between">
                            <div>
                                <div class="flex items-center mb-2">
                                    <x-heroicon-s-chart-bar class="w-4 h-4 dark:text-white {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                                    <p class="text-gray-400 dark:text-gray-50">{{__('course.level')}}: {{__('course.' . $course->level)}}</p>
                                </div>
                                <div class="flex items-center mb-2">
                                    <x-heroicon-o-clock class="w-4 h-4 dark:text-white {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                                    <p class="text-gray-400 dark:text-gray-50">
                                        {{__('course.duration')}}: 
                                        <?php
                                            $hours = floor($course->duration / 3600);
                                            $minutes = floor(($course->duration % 3600) / 60);
                                            $seconds = $course->duration % 60;
                                        ?>
                                        {{$hours>0 ? ($hours==1 ? (__('course.1h').' ') : ($hours.__('course.h').' ')): ('')}}
                                        {{$minutes>0 ? ($minutes==1 ? __('course.1m') : ($minutes.__('course.m'))): ('')}}
                                    </p>
                                </div>
                                <div class="flex items-center mb-2">
                                    <x-heroicon-s-play-circle class="w-4 h-4 dark:text-white {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                                    <p class="text-gray-400 dark:text-gray-50">{{$course->nb_lessons> 0 ? ($course->nb_lessons==1 ? __('course.1Lesson') : ($course->nb_lessons.' '.__('course.Lessons'))): __('course.No-Lessons')}}</p>
                                </div>
                                <div class="flex items-center mb-2">
                                    <x-heroicon-s-speaker-wave class="w-4 h-4 dark:text-white {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                                    <p class="text-gray-400 dark:text-gray-50">{{__('course.course-lang')}}: {{__('course.' . $course->language)}}</p>
                                </div>
                                <div class="flex mb-2">
                                    <x-heroicon-s-language class="w-4 h-4 mt-1 dark:text-white {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                                    <p class="text-gray-400 dark:text-gray-50">
                                        {{__('course.translations')}}: 
                                        @if($course->translations != null)
                                            <?php $i = 0; ?>
                                            @foreach(json_decode($course->translations) as $trans)
                                            <?php $i++; ?>
                                                {{__('course.' . ucfirst($trans))}}
                                            @if($i < count(json_decode($course->translations)))
                                                .
                                            @endif
                                            @endforeach
                                        @else
                                            {{__('course.no-translation')}}
                                        @endif
                                    </p>
                                </div>
                                <div class="flex flex-wrap space-x-2 items-center">
                                    <x-heroicon-s-banknotes class="h-4 w-4 dark:text-white {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}"/>
                                    <p class="text-gray-700 dark:text-white {{$course->is_discount ? ('line-through text-sm'):('text-xl text-red-500')}}">${{$course->price}} {{__('course.USD')}}</p>
                                    @if($course->is_discount)
                                    <p class="text-xl text-red-500">
                                        ${{$course->discount_price}} {{__('course.USD')}}
                                    </p>
                                    <p class="text-gray-700 dark:text-white text-sm">
                                        {{__('course.discount')}} {{$course->discount}}%
                                    </p>
                                    @endif
                                </div>
                            </div>
                            <div class=" text-gray-700 px-1.5 py-1 rounded-full bg-gray-100 h-fit">
                                <x-heroicon-o-bookmark  class="h-6 w-5"/>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('lesson.showCourse', ['url' => $course->url, 'number' => 1]) }}">
                        <button class="w-full mt-8 bg-red-500 text-white text-center py-1 rounded-md hover:shadow hover:bg-red-700">
                            {{__('course.buy-course')}}
                        </button>
                    </a>
                </div>
            </div>

            <div class="flex space-x-2 mt-8" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="font-semibold text-primary-700 dark:text-white text-lg {{$lang=='ar' ? ('ml-2') : ('mr-2')}}">{{__('course.categories:')}}</p>
                @foreach($categories as $category)
                    <a href="{{ route('category.showUrl', ['url' => $category->url]) }}"
                        class="font-normal text-primary-700 dark:text-white text-lg pb-0.5 border-b border-b-primary-700 dark:border-b-white">
                        {{$lang=='ar' ? ($category->title_ar) : ($category->title_en) }}
                    </a>
                @endforeach
            </div>
            <div class="flex my-10 items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                <img src="{{asset($course->instructor->image)}}" class="rounded-full w-20 h-20" alt="">
                <div class="{{$lang == 'ar' ? ('text-right mr-5') : ('ml-5')}}">
                    <p class="font-bold text-xl text-gray-400 dark:text-gray-50 mb-1">{{$course->instructor->firstname}} {{$course->instructor->lastname}}</p>
                    <p class="font-medium text-base text-gray-300 dark:text-gray-100">{{$course->instructor->short_desc}}</p>
                </div>
            </div>
            <div class="bg-primary-200 dark:bg-gray-400 rounded-lg p-8 {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                <p class="{{$lang == 'ar' ? ('text-right') : ('font-medium')}} text-gray-400 dark:text-gray-50">
                    {{$lang == 'ar' ? ($course->description_ar) : ($course->description_en)}}
                </p>
                <div class="mt-6 flex justify-between {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                    <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                        <x-heroicon-o-clock class="w-4 h-4 text-red-700 dark:text-red-500 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p class="text-red-700 dark:text-red-500">
                            {{__('course.duration')}}: 
                            <?php
                                $hours = floor($course->duration / 3600);
                                $minutes = floor(($course->duration % 3600) / 60);
                                $seconds = $course->duration % 60;
                            ?>
                            {{$hours>0 ? ($hours==1 ? (__('course.1h').' ') : ($hours.__('course.h').' ')): ('')}}
                            {{$minutes>0 ? ($minutes==1 ? __('course.1m') : ($minutes.__('course.m'))): ('')}}
                            / {{$course->nb_lessons> 0 ? ($course->nb_lessons==1 ? __('course.1Lesson') : ($course->nb_lessons.' '.__('course.Lessons'))): __('course.No-Lessons')}}
                        </p>
                    </div>
                    <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                        <x-heroicon-s-speaker-wave class="w-4 h-4 text-red-700 dark:text-red-500 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p class="text-red-700 dark:text-red-500">{{__('course.course-lang')}}: {{__('course.' . $course->language)}}</p>
                    </div>
                    <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                        <x-heroicon-s-calendar-days class="w-4 h-4 text-red-700 dark:text-red-500 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p class="text-red-700 dark:text-red-500">{{__('course.release-date')}}: {{substr($course->created_at, 0, 10)}}</p>
                    </div>
                </div>
            </div>
            <div class="my-14" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-3xl text-gray-700 dark:text-white {{$lang == 'ar' ? ('font-medium') : ('font-semibold')}}">{{__('course.course-features')}}</p>
                <div class="text-gray-700 dark:text-white {{$lang == 'ar' ? ('text-right') : ('font-medium')}}">
                    <div class="flex items-center  mt-8">
                        <x-heroicon-s-lock-closed class="w-5 h-5 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p>{{__('course.access-course-content')}}</p>
                    </div>
                    <div class="flex items-center  mt-6">
                        <x-heroicon-s-book-open class="w-5 h-5 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p>{{__('course.learn-own-pace')}}</p>
                    </div>
                    <div class="flex items-center  mt-6">
                        <x-heroicon-s-check-badge class="w-5 h-5 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p>{{__('course.completion-certificate')}}</p>
                    </div>
                    <div class="flex items-center  mt-6">
                        <x-heroicon-s-chat-bubble-left-right class="w-5 h-5 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p>{{__('course.ask-instructor')}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-blue-200 dark:bg-gray-400 rounded-lg p-8" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-3xl text-gray-700 dark:text-white {{$lang == 'ar' ? ('font-medium') : ('font-semibold')}}">{{__('course.course-req')}}</p>
                <div class="text-gray-700 dark:text-white mb-4 {{$lang == 'ar' ? ('text-right') : ('font-medium')}}">
                    @if($lang=='ar')
                        @if($course->requirements_en != null)
                            @foreach(json_decode($course->requirements_ar) as $req)
                            <div class="flex items-center  mt-8">
                                <x-heroicon-s-stop class="w-4 h-4 ml-2" />
                                <p>{{$req}}</p>
                            </div>
                            @endforeach
                        @endif
                    @else
                        @if($course->requirements_en != null)
                            @foreach(json_decode($course->requirements_en) as $req)
                            <div class="flex items-center  mt-8">
                                <x-heroicon-s-stop class="w-4 h-4 mr-2" />
                                <p>{{$req}}</p>
                            </div>
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <x-footer/>
    </div>
</x-app-layout>
<style>
    iframe {
        border-radius: 1rem;
    }
    .iframe-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        /* padding-top: 56.25%; 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
    }
    .responsive-iframe {
        position: absolute;
        /* top: 0; */
        left: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        height: 100%;
    }
</style>
<script src="https://player.vimeo.com/api/player.js"></script> 
<script>
    function showVideoFrame() {
        // Hide the placeholder and show the video iframe
        document.getElementById('video-placeholder').style.display = 'none';
        document.getElementById('vimeo-frame').style.display = 'block';
    }
</script>