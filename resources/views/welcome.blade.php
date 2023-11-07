<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <?php
        function checkCount($arr) {
            $count = count($arr);

            if ($count < 2) {
                return 'sm:hidden';
            } elseif ($count < 3) {
                return 'md:hidden';
            } elseif ($count < 4) {
                return 'lg:hidden';
            } elseif ($count < 5) {
                return 'xl:hidden';
            } else {
                return 'block';
            }
        }
    ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="md:hidden h-20"></div>
        <input id="lang" type="hidden" value="{{$lang}}" />
        <div class="mx-auto flex justify-center">
            <video class="md:h-[30rem]" muted autoplay controls>
                <source src="{{ asset('pictures/barzakh.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="flex justify-center">
        
            <div class="sm:px-6 lg:px-8 my-8 py-8 text-center max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-3xl border-b-2 border-b-primary-500 dark:border-b-gray-50">
                <x-bi-quote class="w-16 h-16 text-bordo mb-4 mx-auto" />
                <p class="text-xl text-bordo tracking-wider leading-10 dark:text-primary-100" style="font-family:{{$lang=='ar' ? ('Noto') : ('Nunito')}}">
                    {{__('welcome.Charter-content')}}
                </p>
            </div>
        </div>
        <div id="courses" class="max-w-xs sm:max-w-xl md:max-w-xl lg:max-w-3xl mx-auto py-32 ">
            <div class="flex justify-center">
                <p class="text-2xl md:text-3xl lg:text-5xl text-bordo dark:text-white font-black mb-16 {{$lang=='ar'?('text-right'):('')}}">
                    {{__('welcome.our-content')}}
                </p>
            </div>
            <div class="flex justify-center">
                <div class="xs:columns-1 md:columns-3 md:gap-4 lg:gap-8" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}">
                @foreach($fields as $field)
                <a href="{{ route('fields.showUrl', ['url' => $field->url]) }}">
                    <div class="h-72 w-72 md:h-52 md:w-52 lg:h-72 lg:w-72 my-6 md:my-0 cat-circle hover:shadow-lg rounded-full">  
                        <div class="h-2/5 flex items-center justify-center text-center">
                            <div class="w-48">
                                <p class="text-xl md:text-lg lg:text-xl text-bordo font-semibold" style="font-family:{{$lang=='ar' ? ('Noto') : ('Nunito')}}">
                                    {{ $field->title }}
                                </p>
                            </div>
                        </div>
                        <div class="h-3/5 p-8 text-center">
                            <p class="text-xl md:text-lg lg:text-xl font-normal text-gray-400">{{ $field->subtitle }}</p>
                        </div> 
                    </div>
                </a>
                @endforeach
                </div>
            </div>
        </div>
        @if(Auth::user())
        <div id="free" class="container pt-16 pb-8 sm:max-w-xl md:max-w-2xl lg:max-w-screen-lg xl:max-w-screen-2xl mx-auto">
            <p class="text-2xl md:text-3xl lg:text-5xl text-primary-700 dark:text-white font-black px-4 md:px-8 lg:px-16 mb-4 {{$lang=='ar'?('text-right'):('')}}">
                {{__('welcome.finish-started')}}
            </p>
            <div class="items-center container py-8  sm:max-w-xl md:max-w-2xl lg:max-w-screen-lg xl:max-w-screen-2xl  mx-auto mt-4 flex space-x-4 justify-center">
                <button class="myPrevBtn h-56 bg-primary-150 text-stone dark:bg-gray-400 dark:hover:text-gray-700 dark:hover:bg-primary-200 dark:text-primary-50
                     rounded-xl hover:bg-primary-300 shadow-md px-2 hidden sm:block 
                     {{checkCount($myCourses)}}">
                    <x-heroicon-s-chevron-left class="w-4 h-4"/>
                </button>
                <div class="owl-carousel my-owl owl-theme w-10/12">
                    <!-- Carousel Items -->
                    @foreach($myCourses as $course)
                    <div class="item">
                        <x-course :course="$course" />
                    </div>
                    @endforeach
                    <div class="item"></div>
                    <!-- Add more items as needed -->
                </div>
                <button class="myNextBtn h-56 bg-primary-150 text-stone dark:bg-gray-400 dark:hover:text-gray-700 dark:hover:bg-primary-200 dark:text-primary-50 rounded-xl hover:bg-primary-300 shadow-md px-2 hidden sm:block {{checkCount($myCourses)}}">
                    <x-heroicon-s-chevron-right class="w-4 h-4"/>
                </button>
            </div>
        </div>
        @endif
        <div class="">
            <div class="tabs container py-16 sm:max-w-xl md:max-w-2xl lg:max-w-screen-lg xl:max-w-screen-2xl mx-auto">
                <p class="text-2xl md:text-3xl lg:text-5xl text-primary-700 dark:text-white font-black px-4 md:px-8 lg:px-16 mb-4 {{$lang=='ar'?('text-right'):('')}}">
                    {{__('welcome.chose-for-you')}}
                </p>
                <ul class="tab-links px-4 md:px-8 lg:px-16 {{$lang=='ar'?('flex-row-reverse'):('')}}">
                    <li class="tab-link active" data-tab="tab-1">{{__('welcome.chosen-courses')}}</li>
                    <li class="tab-link" data-tab="tab-2">{{__('welcome.most-watched')}}</li>
                    <li class="tab-link" data-tab="tab-3">{{__('welcome.most-recent')}}</li>
                    <!-- Add more tab links as needed -->
                </ul>
                @foreach ($courses as $key => $courseType)
                <div id="tab-{{$key}}-content" class="tab-content items-center {{$key!='1' ? ('hidden') : ('')}} container py-8 sm:max-w-xl md:max-w-2xl lg:max-w-screen-lg xl:max-w-screen-2xl  mx-auto mt-4 flex space-x-4 justify-center">
                    <button class="prevBtn h-56 bg-primary-150 text-stone dark:bg-gray-400 dark:hover:text-gray-700 dark:hover:bg-primary-200 dark:text-primary-50 rounded-xl hover:bg-primary-300 shadow-md px-2 hidden sm:block">
                        <x-heroicon-s-chevron-left class="w-4 h-4"/>
                    </button>
                    <div class="owl-carousel owl-tabs owl-theme w-10/12">
                        <!-- Carousel Items -->
                        @foreach($courseType as $course)
                        <div class="item">
                            <x-course :course="$course" />
                        </div>
                        @endforeach
                        <!-- Add more items as needed -->
                    </div>
                    <button class="nextBtn h-56 bg-primary-150 text-stone dark:bg-gray-400 dark:hover:text-gray-700 dark:hover:bg-primary-200 dark:text-primary-50 rounded-xl hover:bg-primary-300 shadow-md px-2 hidden sm:block">
                        <x-heroicon-s-chevron-right class="w-4 h-4"/>
                    </button>
                </div>
                @endforeach
                <!-- Add more tab content containers as needed -->
            </div>
        </div>
        <div id="free" class="container pt-16 pb-8 sm:max-w-xl md:max-w-2xl lg:max-w-screen-lg xl:max-w-screen-2xl mx-auto">
            <p class="text-2xl md:text-3xl lg:text-5xl text-primary-700 dark:text-white font-black px-4 md:px-8 lg:px-16 mb-4 {{$lang=='ar'?('text-right'):('')}}">
                {{__('welcome.free-courses')}}
            </p>
            <div class="items-center container py-8  sm:max-w-xl md:max-w-2xl lg:max-w-screen-lg xl:max-w-screen-2xl  mx-auto mt-4 flex space-x-4 justify-center">
                <button class="prevBtnFree h-56 bg-primary-150 text-stone dark:bg-gray-400 dark:hover:text-gray-700 dark:hover:bg-primary-200 dark:text-primary-50 rounded-xl hover:bg-primary-300 shadow-md px-2 hidden sm:block {{checkCount($freeCourses)}}">
                    <x-heroicon-s-chevron-left class="w-4 h-4"/>
                </button>
                <div class="owl-carousel owl-free owl-theme w-10/12">
                    <!-- Carousel Items -->
                    @foreach($freeCourses as $course)
                    <div class="item">
                        <x-course :course="$course" />
                    </div>
                    @endforeach
                    <div class="item"></div>
                    <!-- Add more items as needed -->
                </div>
                <button class="nextBtnFree h-56 bg-primary-150 text-stone dark:bg-gray-400 dark:hover:text-gray-700 dark:hover:bg-primary-200 dark:text-primary-50 rounded-xl hover:bg-primary-300 shadow-md px-2 hidden sm:block {{checkCount($freeCourses)}}">
                    <x-heroicon-s-chevron-right class="w-4 h-4"/>
                </button>
            </div>
        </div>
        <div id="instructors" class="px-8 py-32 max-w-xs sm:max-w-xl md:max-w-2xl lg:max-w-4xl mx-auto">
            <p class="text-2xl md:text-3xl lg:text-5xl text-gray-500 dark:text-white font-black  mb-12 text-center">
                {{__('welcome.our-instructors')}}
            </p>
            <div class="mt-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($instructors as $instructor)
                    <div class="group relative instructor">
                        <a href="{{ route('instructor.showUrl', ['url' => $instructor->url]) }}">
                            <img class="h-auto max-w-full" src="{{ asset($instructor->image) }}" alt="">
                            <div class="group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 instructor-details bg-stone text-white py-4 px-4 bg-opacity-70">
                                <div class="{{$lang == 'ar' ? ('text-right') : ('')}}">
                                    <p class="text-xl font-semibold">{{$instructor->firstname}} {{$instructor->lastname}}</p>
                                    <p class="text-sm font-medium text-gray-50" style="font-family:'Nunito'">{{$instructor->email}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="flex justify-center space-x-16 pb-32">
            <img src="{{ asset('pictures/global/barzakh-freelance.png') }}" class="h-28 sm:h-52 dark:hidden" alt=""/>
            <img src="{{ asset('pictures/global/barzakh-freelance-white.png') }}" class="h-28 sm:h-52 hidden dark:block" alt=""/>
            <img src="{{ asset('pictures/global/barzakh-store.png') }}" class="h-28 sm:h-52 dark:hidden" alt=""/>
            <img src="{{ asset('pictures/global/barzakh-store-white.png') }}" class="h-28 sm:h-52 hidden dark:block" alt=""/>
        </div>
        <x-footer/>
    </div>
    <style>
        @tailwind base;
        @tailwind components;
        @tailwind utilities;
        .eye-shape {
            border-radius: 100% 0px;
            transform: rotate(45deg); 
            width: 188px;
            height: 188px
        }
        .cat-circle {
            background-image: url('{{ asset('pictures/global/cat-circle.png') }}');
            background-size: contain;
            background-position: center;
        }
        /* .cat-title {
            font-family: 'IBM Plex Sans Arabic', sans-serif;
        } */
         /* Tabs styling */

        .tab-links {
            display: flex;
            list-style: none;
            gap: 1rem;
            margin-bottom: 1rem;
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
        .instructor-details {
            position: absolute;
            visibility: hidden;
            top: 60%;
            height: 40%;
            width: 100%;
            opacity: 0;
            transition: opacity 0.25s ease-in-out;
        }
    </style>
</x-app-layout>

<script>
    const lang = document.getElementById('lang').value;
    $(document).ready(function() {
        $(".owl-tabs").owlCarousel({
            items: 4, // Number of items to display
            loop: true, // Infinite loop
            rtl: lang=='ar',
            margin: 20, // Margin between items
            nav: false, // Display navigation buttons
            dots: false, // Hide navigation dots
            responsive: {
                0: {
                    items: 1.5
                },
                640: {
                    items: 2
                },
                768: {
                    items: 3
                },
                1024: {
                    items: 4
                },
                1280: {
                    items: 4.5
                }
            }
        });

        // Custom navigation button actions
        $(".prevBtn").click(function () {
            if(lang=='ar'){
                $(".owl-tabs").trigger("next.owl.carousel");
            } else {
                $(".owl-tabs").trigger("prev.owl.carousel");
            }
        });

        $(".nextBtn").click(function () {
            if(lang=='ar'){
                $(".owl-tabs").trigger("prev.owl.carousel");
            } else {
                $(".owl-tabs").trigger("next.owl.carousel");
            }
        });

        $(".owl-free").owlCarousel({
            loop: false,
            margin: 20,
            nav: false,
            dots: false,
            rtl: lang=='ar',
            responsive: {
                0: { items: 1.5 },
                640: { items: 2 },
                768: { items: 3 },
                1024: { items: 4 },
                1280: { items: 4.5 }
            }
        });

        $(".prevBtnFree").click(function () {
            if(lang=='ar'){
                $(".owl-free").trigger("next.owl.carousel");
            } else {
                $(".owl-free").trigger("prev.owl.carousel");
            }
        });

        $(".nextBtnFree").click(function () {
            if(lang=='ar'){
                $(".owl-free").trigger("prev.owl.carousel");
            } else {
                $(".owl-free").trigger("next.owl.carousel");
            }
        });

        $(".my-owl").owlCarousel({
            items: 4,
            loop: false,
            margin: 20,
            nav: false,
            dots: false,
            rtl: lang=='ar',
            responsive: {
                0: { items: 1.5 },
                640: { items: 2 },
                768: { items: 3 },
                1024: { items: 4 },
                1280: { items: 4.5 }
            }
        });

        $(".myPrevBtn").click(function () {
            if(lang=='ar'){
                $(".my-owl").trigger("next.owl.carousel");
            } else {
                $(".my-owl").trigger("prev.owl.carousel");
            }
        });

        $(".myNextBtn").click(function () {
            if(lang=='ar'){
                $(".my-owl").trigger("prev.owl.carousel");
            } else {
                $(".my-owl").trigger("next.owl.carousel");
            }
        });
    });
</script>
<script>
    const tabLinks = document.querySelectorAll('.tab-link');

    tabLinks.forEach((link) => {
        link.addEventListener('click', () => {
            const tabId = link.getAttribute('data-tab');
            const tabContents = document.querySelectorAll('.tab-content');

            tabContents.forEach((content) => {
                content.classList.remove('flex');
                content.classList.add('hidden');
            });

            const activeTabContent = document.getElementById(`${tabId}-content`);
            activeTabContent.classList.add('flex');
            activeTabContent.classList.remove('hidden');

            tabLinks.forEach((tabLink) => {
                tabLink.classList.remove('active');
            });

            link.classList.add('active');
        });
    });
</script>