<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-screen-sm md:max-w-xl lg:max-w-4xl xl:max-w-6xl mx-auto mt-8 md:-mt-20 mb-56">
            <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-10 container mt-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="col-span-3">
                    <div class="mb-8">
                        <p class="text-3xl font-semibold text-primary-700 dark:text-white">{{$lang=='ar' ? $lesson->title_ar : $lesson->title_en}}</p>
                    </div>
                    <div class="iframe-container rounded-xl h-[150px] sm:h-[298px] md:h-[272px] lg:h-[310px] xl:h-[400px]">
                        <div id="video-placeholder" class="w-full h-full">
                            <img src="{{ asset('/pictures/vid-placeholder.png') }}" alt="Video Placeholder" class="w-full h-full object-cover">
                        </div>
                        <iframe 
                            id="vimeo-frame" 
                            class="responsive-iframe -mt-6"
                            src="https://player.vimeo.com/video/{{$lesson->video_url}}?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" 
                            frameborder="0" allow="autoplay; fullscreen;" 
                            title="{{$lesson->title_en}}" onload="showVideoFrame()">
                        </iframe>
                    </div>
                    
                    <div class="mt-8 dark:text-gray-50"><p>
                    {{$lang=='ar' ? $lesson->description_ar : $lesson->description_en}}
                    </p></div>
                </div>
                <div class="px-4 col-span-1" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                    <div class="lg:fixed lg:top-[20%] xl:top-[23%] h-2/3 w-full max-w-xs bg-white dark:bg-gray-400 shadow-lg rounded-xl overflow-y-auto dark:scrollbar-thumb-dark">
                        <ul class="py-4">
                            @foreach($lessons as $l)
                            <li class="py-2 px-4 hover:bg-primary-200 dark:text-gray-50 dark:hover:bg-gray-300 dark:hover:text-white cursor-pointer">
                                <a class="block w-full h-full" href="{{ route('lesson.showCourse', ['url' => $course->url, 'number' => $l->number]) }}">
                                    {{__('lesson.lesson')}} {{$l->number}}: {{$lang=='ar' ? $l->title_ar : $l->title_en}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
            
        </div>
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
    .overflow-y-auto::-webkit-scrollbar {
        width: 12px;
    }
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background-color: #4a5568;
    }
    .scrollbar-thumb-dark {
        background-color: #cccccc; /* Dark theme scrollbar thumb color */
    }
</style>
<script>
    function showVideoFrame() {
        // Hide the placeholder and show the video iframe
        document.getElementById('video-placeholder').style.display = 'none';
        document.getElementById('vimeo-frame').style.display = 'block';
    }

</script>