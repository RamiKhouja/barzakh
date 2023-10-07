<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="md:hidden h-20"></div>
        <div class="mx-auto flex justify-center">
            <video class="md:h-[30rem]" muted autoplay>
                <source src="{{ asset('pictures/barzakh.mp4') }}" type="video/mp4">
            </video>
        </div>
        <div class="flex justify-center">
            <div class="sm:px-6 lg:px-8 my-8 py-8 text-center max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-3xl border-b-2 border-b-primary-500 dark:border-b-gray-50">
                <p class="text-2xl mb-4 text-gray-700 font-semibold dark:text-white">{{__('welcome.Charter')}}</p>
                <p class="text-lg dark:text-gray-50">{{__('welcome.Charter-content')}}</p>
            </div>
        </div>
        <div id="courses" class="max-w-xs sm:max-w-xl md:max-w-xl lg:max-w-3xl mx-auto my-32">
            <div class="flex justify-center">
                <div class="xs:columns-1 md:columns-3 md:gap-4 lg:gap-8">
                @foreach($fields as $field)
                <a href="{{ route('fields.showUrl', ['url' => $field->url]) }}">
                    <div class="h-72 w-72 md:h-52 md:w-52 lg:h-72 lg:w-72 my-6 md:my-0 cat-circle hover:shadow-lg rounded-full">  
                        <div class="h-2/5 flex items-center justify-center text-center">
                            <div class="w-48">
                                <p class="text-xl md:text-lg lg:text-xl text-gray-700 font-ibm font-semibold">{{ $field->title }}</p>
                            </div>
                        </div>
                        <div class="h-3/5 p-8 text-center">
                            <p class="text-xl md:text-lg lg:text-xl font-ibm font-normal text-gray-400">{{ $field->subtitle }}</p>
                        </div> 
                    </div>
                </a>
                @endforeach
                </div>
            </div>
        </div>
        <div class="mt-28">
            <div class="tabs container py-8 max-w-xs sm:max-w-xl md:max-w-7xl mx-auto">
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
                <div id="tab-{{$key}}-content" class="tab-content {{$key!='1' ? ('hidden') : ('')}} container py-8 max-w-xs sm:max-w-xl md:max-w-7xl mx-auto mt-4 flex space-x-4 justify-center">
                    <button class="prevBtn bg-stone text-white rounded-xl hover:bg-gray-400 px-2 hidden sm:block">
                        <x-heroicon-s-chevron-left class="w-4 h-4"/>
                    </button>
                    <div class="owl-carousel owl-theme w-10/12">
                        <!-- Carousel Items -->
                        @foreach($courseType as $course)
                        <div class="item">
                            <div class="rounded-3xl group">
                                <img src="{{ asset($course->image) }}" alt="Slide 1" class="max-h-32 rounded-t-3xl">
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
                                    <div class="flex justify-between items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                                        <p class="text-base text-gray-200">
                                            {{$course->instructor->firstname}} {{$course->instructor->lastname}}
                                        </p>
                                        <div class=" text-gray-50 px-1.5 py-1 border border-gray-50 rounded-full bg-gray-400">
                                        <x-heroicon-s-bookmark  class="h-6 w-5"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- Add more items as needed -->
                    </div>
                    <button class="nextBtn bg-stone text-white rounded-xl hover:bg-gray-400 px-2 hidden sm:block">
                        <x-heroicon-s-chevron-right class="w-4 h-4"/>
                    </button>
                </div>
                @endforeach
                <!-- Add more tab content containers as needed -->
            </div>
        </div>
        <div class=" p-12 sm:p-32">
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 sm:gap-10">
                @foreach($instructors as $instructor)
                <div class="group relative">
                    <img class="h-auto max-w-full" src="{{ asset($instructor->image) }}" alt="">
                    <div class="group-hover:visible group-hover:translate-y-0 instructor-details bg-stone text-white py-4 px-4 bg-opacity-70">
                        <div class="{{$lang == 'ar' ? ('text-right') : ('')}}">
                            <p class="text-xl font-semibold">{{$instructor->firstname}} {{$instructor->lastname}}</p>
                            <p class="text-base font-medium text-gray-50">{{$instructor->email}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
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
            transform: translateY(100%);
            transition: transform .25s linear;
        }
    </style>
</x-app-layout>

<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            items: 4, // Number of items to display
            loop: true, // Infinite loop
            margin: 20, // Margin between items
            nav: false, // Display navigation buttons
            dots: false, // Hide navigation dots
            responsive: {
                0: {
                    items: 1
                },
                640: {
                    items: 2
                },
                768: {
                    items: 3
                },
                1024: {
                    items: 4
                }
            }
        });

        // Custom navigation button actions
        $(".prevBtn").click(function () {
            $(".owl-carousel").trigger("prev.owl.carousel");
        });

        $(".nextBtn").click(function () {
            $(".owl-carousel").trigger("next.owl.carousel");
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
