<?php $lang = app()->getLocale(); ?>
<div class="rounded-3xl my-4 group shadow-md group">
    
        <div class="relative">
            @if($status)
            <a href="{{ route('course.showUrl', ['url' => $course->url]) }}">
            <div class="relative">
                <img src="{{ asset( 'pictures/'.$course->image ) }}" alt="Slide 1" class="h-32 w-full object-cover rounded-t-3xl">
                <div class="absolute top-2 right-2 {{$status=='pending' ? 'bg-bordo' : ($status=='accepted' ? 'bg-green-700' : 'bg-red-700')}} rounded-full shadow px-2 py-1">
                    <p class="text-sm text-white font-semibold">{{ __('profile.' . $status) }}</p>
                </div>
                @if($course->is_soon)
                <div class="absolute top-4 right-4 bg-bordo text-white text-base font-medium px-4 py-1.5 rounded-lg shadow">
                    {{ __('welcome.coming-soon') }}
                </div>
                @endif
            </div>
            </a>
            @else
            <a href="{{ route('course.showUrl', ['url' => $course->url]) }}">
                <div class="relative">
                    <img src="{{ asset( 'pictures/'.$course->image ) }}" 
                         alt="Slide 1" 
                         class="h-32 w-full object-cover rounded-t-3xl">
                    
                    @if($course->is_soon)
                    <div class="absolute top-4 right-4 bg-bordo text-white text-base font-medium px-4 py-1.5 rounded-lg shadow">
                        {{ __('welcome.coming-soon') }}
                    </div>
                    @endif
                </div>
            </a>
            @endif
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
            @php 
                $percentage=0;
                if($completed && $completed>0 && $course->nb_lessons>0) {
                    $percentage=$completed*100/$course->nb_lessons;
                }
                $progress = 'h-1.5 w-['.$percentage.'%] bg-bordo absolute top-0 left-0';
            @endphp
            <div class="group-hover:bg-primary-300 relative rounded-b-3xl p-4 bg-primary-150 dark:bg-gray-400 dark:group-hover:bg-gray-500">
                @if($percentage>0) 
                    <div class="h-1 bg-gray-200 shadow-inner w-full absolute top-0 left-0"></div>   
                    <div class="h-1 {{ $percentage>70 ? ('w-3/4') : ($percentage > 60 ? ('w-2/3') : ($percentage>40 ? ('w-1/2') : ('w-1/4'))) }}  bg-bordo absolute top-0 {{$lang == 'ar' ? 'right-0 rounded-l' : 'left-0 rounded-r' }}"></div>
                @endif
                <a href="{{ route('course.showUrl', ['url' => $course->url]) }}">
                <p class="text-xl md:text-base lg:text-xl text-stoned-900 dark:text-primary-100 font-medium mb-4 {{$lang == 'ar' ? ('text-right') : ('')}}" title="{{$lang == 'ar' ? ($course->title_ar) : ($course->title_en)}}">
                  <?php
                  $title = '';
                  if($lang== 'ar') {
                    $title = strlen($course->title_ar) > 40 ? substr($course->title_ar, 0, 40) . '...' : $course->title_ar;
                  } else {
                    $title = strlen($course->title_en) > 20 ? substr($course->title_en, 0, 18) . '...' : $course->title_en;
                  }
                  ?>  
                    {{ $title }}
                </p>
                </a>
                <div class="flex justify-between items-center">
                    <p class="text-base text-stone dark:text-primary-200">
                        {{$course->instructor->firstname}} {{$course->instructor->lastname}}
                    </p>
                    <div class="flex justify-between items-center gap-x-2">
                        
                        <x-dropdown width="48">
                            <x-slot name="trigger">
                                <button class="text-gray-50 z-30 px-1.5 py-1.5 border border-gray-50 rounded-full bg-bordo flex items-center space-x-1">
                                    <x-heroicon-s-share class="h-5 w-5"/>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link 
                                    :href="'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(route('course.showUrl', ['url' => $course->url])) . '&picture=' . urlencode(asset('pictures' . $course->image))" target="_blank"
                                    class="flex gap-x-2 items-center"
                                >
                                    <img src="{{ asset('pictures/global/fb-share.png') }}" class="w-6 h-6 btn-share" alt=""/>
                                    <p class="text-sm font-semibold text-stone dark:text-primary-200">{{ __('course.facebook') }}</p>
                                </x-dropdown-link>
                                <x-dropdown-link 
                                    :href="'https://wa.me/?text=' . urlencode(route('course.showUrl', ['url' => $course->url]))" target="_blank"
                                    class="flex gap-x-2 items-center"
                                >
                                    <img src="{{ asset('pictures/global/wp-share.png') }}" class="w-6 h-6 btn-share" alt=""/>
                                    <p class="text-sm font-semibold text-stone dark:text-primary-200">{{ __('course.whatsapp') }}</p>
                                </x-dropdown-link>
                                <x-dropdown-link 
                                    :href="'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode(route('course.showUrl', ['url' => $course->url]))" target="_blank"
                                    class="flex gap-x-2 items-center"
                                >
                                    <img src="{{ asset('pictures/global/ln-share.png') }}" class="w-6 h-6 btn-share" alt=""/>
                                    <p class="text-sm font-semibold text-stone dark:text-primary-200">{{ __('course.linkedin') }}</p>
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                        
                        @if(Auth::check())
                        <a 
                            href="{{ route('course.save', ['id' => $course->id]) }}"
                            class="text-gray-50 z-30 px-1.5 py-1 border border-gray-50 rounded-full bg-gray-400">
                            <x-heroicon-s-bookmark  class="h-6 w-5"/>
                        </a>
                        @endif
                    </div>
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