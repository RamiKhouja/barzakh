<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <?php
            $time = 0;
            if($lessonUser) {
                if($lessonUser->time_stopped_watching >= $lesson->duration){
                    $time = $lesson->duration;
                } else {
                    $time = $lessonUser->time_stopped_watching;
                }
            }
        ?>
        <input type="hidden" id="time" value="{{ $time }}" />
        <input type="hidden" id="lesson_id" value="{{ $lesson->id }}" />
        <input type="hidden" id="duration" value="{{ $lesson->duration }}" />
        <div class="max-w-xs sm:max-w-screen-sm md:max-w-xl lg:max-w-4xl xl:max-w-6xl mx-auto mt-8 md:-mt-20 lg:mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-4 lg:gap-10 container mt-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="col-span-3">
                    <div class="iframe-container rounded-xl h-[150px] sm:h-[298px] md:h-[272px] lg:h-[310px] xl:h-[400px]">
                        <div id="video-placeholder" class="w-full h-full">
                            <img src="{{ asset('/pictures/vid-placeholder.png') }}" alt="Video Placeholder" class="w-full h-full object-cover">
                        </div>
                        <iframe 
                            id="vimeo-frame" 
                            class="responsive-iframe -mt-6"
                            src="https://player.vimeo.com/video/{{$lesson->video_url}}#t={{$time}}s?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" 
                            frameborder="0" allow="autoplay; fullscreen;" 
                            title="{{$lesson->title_en}}" onload="showVideoFrame()">
                        </iframe>
                    </div>
                    <div class="my-8">
                        <p class="text-3xl font-semibold text-primary-700 dark:text-white">{{$lang=='ar' ? $lesson->title_ar : $lesson->title_en}}</p>
                    </div>
                    <div class="dark:text-gray-50"><p>
                    {{$lang=='ar' ? $lesson->description_ar : $lesson->description_en}}
                    </p></div>
                </div>
                <div class=" md:px-4 col-span-1 mt-8 lg:mt-0" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                    <div class="lg:fixed lg:top-[20%] xl:top-[23%] h-2/3 w-full lg:max-w-xs bg-white dark:bg-gray-400 shadow-lg rounded-xl overflow-y-auto dark:scrollbar-thumb-dark">
                        <ul class="py-4">
                            @foreach($lessons as $l)
                            <li class="px-4 hover:bg-primary-200 dark:text-white dark:hover:bg-gray-300 dark:hover:text-white cursor-pointer">
                                <a class="py-2 border-b border-b-primary-150 w-full h-full flex justify-between items-start" href="{{ route('lesson.showCourse', ['url' => $course->url, 'number' => $l->number]) }}">
                                    <div>
                                        {{__('lesson.lesson')}} {{$l->number}}: {{$lang=='ar' ? $l->title_ar : $l->title_en}}
                                        <div class="flex items-center mt-1">
                                            <x-heroicon-o-clock class="w-4 h-4 {{$lang=='ar'?('ml-2'):('mr-2')}}"/>
                                            <p class="text-sm font-light text-gray-400 dark:text-gray-50">
                                                <?php
                                                    $hours = floor($l->duration / 3600);
                                                    $minutes = floor(($l->duration % 3600) / 60);
                                                    $seconds = $l->duration % 60;
                                                ?>
                                                {{$hours>0 ? ($hours==1 ? (__('welcome.1h').' ') : ($hours.__('welcome.h').' ')): ('')}}
                                                {{$minutes>0 ? ($minutes==1 ? __('welcome.1m') : ($minutes.__('welcome.m'))): ($seconds.__('welcome.s'))}}
                                            </p> 
                                        </div>
                                    </div>
                                    <div>
                                        @if($l->lessonUser && $l->lessonUser->pivot->complete)
                                            <x-heroicon-s-check-circle class="text-bordo h-5 w-5"/>
                                        @endif
                                    </div>
                                </a>
                                <!-- <div class="{{$l->percent > 10 ? ('w-['.$l->percent.'%]') : ('w-0')}} bg-red-500 rounded-sm text-white my-2">{{$l->percent}}</div> -->
                                
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
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    function showVideoFrame() {
        // Hide the placeholder and show the video iframe
        document.getElementById('video-placeholder').style.display = 'none';
        document.getElementById('vimeo-frame').style.display = 'block';
    }
    var vimeoFrame = document.getElementById('vimeo-frame');
    var player = new Vimeo.Player(vimeoFrame);
    var lessonId = document.getElementById('lesson_id').value;
    let timer;
    let currentTime = parseInt(document.getElementById('time').value);
    const duration = parseInt(document.getElementById('duration').value);
    var startPlaying = false;

    function startTimer() {
        timer = setInterval(function() {
            currentTime++;
            // Update the display with the current time if needed
        }, 1000); // Timer increments every second
    }

    player.on('bufferstart', function() {
        console.log("Buffering...");
    });

    player.on('bufferend', function() {
        if(startPlaying) {
            startTimer();
        }
    });

    // Detect when the play button is clicked
    player.on('play', function() {
        startPlaying = true;
        fetch('{{ route("lesson.addview") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token if you're using it
            },
            body: JSON.stringify({
                lesson_id: lessonId
            })
        });

    });
    player.on('pause', function(){
        startPlaying=false;
        clearInterval(timer);
        const newTime = currentTime;
        let complete = false;
        if(duration-newTime <= 10){
            complete = true;
        }

        fetch('{{ route("lesson.updateTime") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token if you're using it
            },
            body: JSON.stringify({
                lesson_id: lessonId,
                time: newTime,
                complete: complete
            })
        });
    });
</script>