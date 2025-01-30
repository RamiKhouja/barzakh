<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700" id="page-container">
        @if ($message = Session::get('success'))
            <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                <div class="ml-3">
                <h3 class="text-sm font-medium text-green-700">{{$message}}</h3>
                </div>
            </div>
        @endif
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-screen-sm lg:max-w-4xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-56">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-10 container mt-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="col-span-2">
                    <div class="iframe-container rounded-xl h-[150px] sm:h-[298px] md:h-[298px] lg:h-[274px] xl:h-[313px]">
                        <div id="video-placeholder" class="w-full h-full">
                            <img src="{{ asset('pictures/vid-placeholder.png') }}" alt="Video Placeholder" class="w-full h-full object-cover">
                        </div>
                        <iframe 
                            id="vimeo-frame" 
                            class="responsive-iframe -mt-6"
                            src="https://player.vimeo.com/video/{{$course->featured_vid}}?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" 
                            frameborder="0" allow="autoplay; fullscreen;" 
                            title="{{$course->title_en}}" onload="showVideoFrame()">
                        </iframe>
                    </div>
                    <div class="flex space-x-2 mt-8" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                        <p class="font-semibold text-primary-700 dark:text-white text-lg {{$lang=='ar' ? ('ml-2') : ('mr-2 italic')}}">{{__('course.categories:')}}</p>
                        @foreach($categories as $category)
                            <a href="{{ route('category.showUrl', ['url' => $category->url]) }}"
                                class="font-normal text-primary-700 dark:text-white text-lg pb-0.5 border-b border-b-primary-700 dark:border-b-white">
                                {{$lang=='ar' ? ($category->title_ar) : ($category->title_en) }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="px-4 sm:max-w-sm lg:max-w-lg mt-6 lg:mt-0" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
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
                    @if($payment != null)
                        @if($payment->status == 'successful')
                        <a href="{{ route('lesson.showCourse', ['url' => $course->url, 'number' => $payment->lesson_nb]) }}">
                            <button class="w-full mt-8 bg-red-500 text-white text-center py-1 rounded-md hover:shadow hover:bg-red-700">
                                {{__('course.go-to-course')}}
                            </button>
                        </a>
                        @endif
                    @else
                        <a href="{{ route('lesson.showCourse', ['url' => $course->url, 'number' => 1]) }}">
                            <button class="w-full mt-8 bg-red-500 text-white text-center py-1 rounded-md hover:shadow hover:bg-red-700">
                                {{__('course.buy-course')}}
                            </button>
                        </a>
                    @endif
                </div>
            </div>
            <div class="flex my-10 items-center" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <img src="{{ asset( 'pictures/'.$course->instructor->image ) }}" class="rounded-full w-20 h-20" alt="">
                <div class="{{$lang == 'ar' ? ('text-right mr-5') : ('ml-5')}}">
                    <a href="{{ route('instructor.showUrl', ['url' => $course->instructor->url]) }}">
                        <p class="font-bold text-xl text-gray-400 dark:text-gray-50 mb-1">{{$course->instructor->firstname}} {{$course->instructor->lastname}}</p>
                    </a>
                    <p class="font-medium text-base text-gray-300 dark:text-gray-100">{{$course->instructor->short_desc}}</p>
                </div>
            </div>
            <div class="bg-primary-200 dark:bg-gray-400 rounded-lg p-8 text-base md:text-xs lg:text-base {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                <p class="{{$lang == 'ar' ? ('text-right') : ('font-medium')}} text-gray-400 dark:text-gray-50">
                    {{$lang == 'ar' ? ($course->description_ar) : ($course->description_en)}}
                </p>
                <div class="mt-6 md:flex justify-between {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                    <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}} mb-4 md:mb-0">
                        <x-heroicon-o-clock class="w-4 h-4 text-primary-700 dark:text-gray-50 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p class="text-primary-700 dark:text-gray-50">
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
                    <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}} mb-4 md:mb-0">
                        <x-heroicon-s-speaker-wave class="w-4 h-4 text-primary-700 dark:text-gray-50 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p class="text-primary-700 dark:text-gray-50">{{__('course.course-lang')}}: {{__('course.' . $course->language)}}</p>
                    </div>
                    <div class="flex items-center {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}">
                        <x-heroicon-s-calendar-days class="w-4 h-4 text-primary-700 dark:text-gray-50 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                        <p class="text-primary-700 dark:text-gray-50">{{__('course.release-date')}}: {{substr($course->created_at, 0, 10)}}</p>
                    </div>
                </div>
            </div>
            <div class="w-full md:grid md:grid-cols-2 md:gap-x-4 lg:gap-x-8 mt-8 md:mt-14">
                <div class="w-full {{$lang=='ar' ? ('order-2') : ('order-1')}} bg-primary-50 dark:bg-gray-400 rounded-xl py-4 md:py-2 lg:py-4 shadow mb-8 md:mb-0 overflow-y-auto max-h-[202px] md:max-h-[124px] lg:max-h-[176px] xl:max-h-[202px]">
                    @php $i=1; @endphp
                    @foreach($course->lessons as $lesson)
                    <button 
                        class="w-full flex justify-between items-center px-4 py-2 md:px-2 md:py-1 lg:px-4 lg:py-2 border-b border-b-primary-150 dark:border-b-gray-500 {{$lesson->is_free ? ('hover:bg-primary-150 dark:hover:bg-gray-500 dark:hover:border-b-gray-500 cursor-pointer') : ('cursor-default')}}" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}"
                        onclick="{{ $lesson->is_free ? 'openLessonModal("' . $lesson->video_url . '")' : '' }}"
                    >
                        <div class="flex gap-x-4 items-center">
                            <p class="text-base text-bordo dark:text-white">{{__('course.the-lesson')}} {{$i++}}</p>
                            <p class="text-lg text-gray-700 dark:text-white">{{$lang=='ar' ? $lesson->title_ar : $lesson->title_en}}</p>
                        </div>
                        <div>
                            @if($lesson->is_free)
                            <x-heroicon-s-play-circle class="w-5 h-5 text-red-700 dark:text-red-500"/>
                            @else
                            <x-heroicon-s-lock-closed class="mx-0.5 w-4 h-4 text-gray-300 dark:text-gray-200"/>
                            @endif
                        </div>
                    </button>
                    @endforeach
                </div>
                <div class="w-full relative shadow-lg rounded-2xl mb-8 md:mb-0 {{$lang=='ar' ? ('order-1') : ('order-2')}}">
                    <!-- <img src="{{ asset('pictures/global/suspack-light.jpg') }}" class="h-auto max-w-full rounded-2xl dark:hidden" alt=""/> -->
                    <img src="{{ asset('pictures/global/suspack-dark.jpg') }}" class="h-auto max-w-full rounded-2xl" alt=""/>
                    <div class="absolute top-2 px-4 sm:px-6 md:px-4 lg:top-4 lg:px-6 xl:px-8 text-center">
                        <p class="text-base md:text-lg lg:text-xl xl:text-2xl text-white  font-black text-center" style="font-family:{{$lang=='ar' ? ('TajNastaleeq') : ('Great Vibes')}}">
                            {{__('welcome.suspeso-system')}}
                        </p>
                        <p class="text-center text-xs lg:text-sm xl:text-base text-gray-50 my-2 sm:mt-2 sm:mb-5 md:my-2 lg:my-3 xl:my-4 {{$lang=='ar'?(''):('italic')}}" dir="{{$lang=='ar'?('rtl'):('ltr')}}">
                            {{__('welcome.suspeso-description')}}
                        </p>
                        <div class="flex justify-center w-full space-x-4 lg:space-x-8 items-center">
                            <button onclick="openModal('offerModal')" type="button" class="rounded-full bg-bordo border border-bordo px-4 md:px-2 lg:px-4 py-1 md:py-0.5 lg:py-1 text-xs lg:text-base font-medium text-white shadow-sm hover:bg-white hover:border-bordo hover:text-bordo {{$lang=='ar'?(''):('italic')}}">{{__('welcome.pay-for-course')}}</button>
                            <button onclick="openModal('demendModal')" type="button" class="rounded-full bg-white border border-bordo px-4 md:px-2 lg:px-4 py-1 md:py-0.5 lg:py-1 text-xs lg:text-base font-medium text-bordo shadow-sm hover:bg-bordo hover:border-bordo hover:text-white {{$lang=='ar'?(''):('italic')}}">{{__('welcome.demend-course')}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:grid md:gap-x-4 lg:gap-x-8 md:grid-cols-2 my-8 md:my-14">
                <div class="bg-primary-150 dark:bg-gray-400 rounded-lg p-8 mb-8 md:mb-0 {{$lang=='ar' ? ('order-2') : ('order-1')}}" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                    <p class="text-3xl text-primary-700 dark:text-white {{$lang == 'ar' ? ('font-medium') : ('font-semibold italic')}}">{{__('course.course-features')}}</p>
                    <div class="text-gray-700 dark:text-white {{$lang == 'ar' ? ('text-right') : ('font-medium')}}">
                        <div class="flex  mt-8">
                            <x-heroicon-s-lock-closed class="w-5 h-5 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                            <p>{{__('course.access-course-content')}}</p>
                        </div>
                        <div class="flex  mt-6">
                            <x-heroicon-s-book-open class="w-5 h-5 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                            <p>{{__('course.learn-own-pace')}}</p>
                        </div>
                        <div class="flex  mt-6">
                            <x-heroicon-s-check-badge class="w-5 h-5 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                            <p>{{__('course.completion-certificate')}}</p>
                        </div>
                        <div class="flex  mt-6">
                            <x-heroicon-s-chat-bubble-left-right class="w-5 h-5 {{$lang == 'ar' ? ('ml-2') : ('mr-2')}}" />
                            <p>{{__('course.ask-instructor')}}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-primary-150 dark:bg-gray-400 rounded-lg p-8" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                    <p class="text-3xl text-primary-700 dark:text-white {{$lang == 'ar' ? ('font-medium') : ('font-semibold italic')}}">{{__('course.course-req')}}</p>
                    <div class="text-gray-700 dark:text-white mb-4 {{$lang == 'ar' ? ('text-right') : ('font-medium')}}">
                        @if($lang=='ar')
                            @if($course->requirements_en != null)
                                @foreach(json_decode($course->requirements_ar) as $req)
                                <div class="flex mt-8">
                                    <x-heroicon-s-stop class="w-6 h-6 ml-2" />
                                    <p>{{$req}}</p>
                                </div>
                                @endforeach
                            @endif
                        @else
                            @if($course->requirements_en != null)
                                @foreach(json_decode($course->requirements_en) as $req)
                                <div class="flex mt-8">
                                    <x-heroicon-s-stop class="w-6 h-6 mr-2" />
                                    <p>{{$req}}</p>
                                </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <x-footer/>
    </div>
    <div class="fixed z-50 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="demendModal">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-3xl p-8 shadow-2xl w-1/3">
                <h2 class="mb-2 text-lg font-semibold text-gray-900">Demend a Course</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo illum alias fugit, ab voluptas facere esse adipisci.</p>
                <form action="{{ route('request.store') }}" method="POST" class="flex flex-col">
                    @csrf
                    <input name="course_id" type="hidden" value="{{$course->id}}"/>
                    <textarea name="message" class="my-8" placeholder="عبّر" id="message" rows="4"></textarea>
                    <div>
                        <button type="submit" class="primary-btn">Submit</button>
                        <button type="button" class="secondary-btn" onclick="closeModal('demendModal')">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="fixed z-50 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="offerModal">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-3xl p-8 shadow-2xl w-1/3">
                <h2 class="mb-2 text-lg font-semibold text-gray-900">Pay a Course</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo illum alias fugit, ab voluptas facere esse adipisci.</p>
                <form method="POST" action="{{ route('offer.store') }}">
                    @csrf
                    @php
                        $price = $course->is_discount ? $course->discount_price : $course->price;
                    @endphp
                    <div class="hidden sm:flex gap-x-16 items-center">
                        <p class="text-lg leading-6 text-bordo dark:text-primary-50 font-semibold">
                            ${{ $price }}
                        </p>
                        <input type="hidden" name="price" value="{{$price}}"/>
                        <input type="hidden" name="course_id" value="{{$course->id}}"/>
                        <div class="w-24 flex gap-x-4 items-center dark:text-primary-100">
                            <label htmlFor="title">
                                {{__('requests.qty')}}
                            </label>
                            <div>
                                <input
                                    type="number"
                                    name="qty"
                                    id="qty"
                                    class="form-input h-7"
                                    placeholder="Qty"
                                    min=1
                                    value=1
                                />
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-x-4">
                        <button type="submit" class="rounded-full bg-bordo dark:bg-primary-50 px-4 py-1 text-xs md:text-sm font-medium text-primary-50 dark:text-gray-500 shadow-sm hover:bg-bordo dark:hover:bg-bordo dark:hover:text-primary-50 {{$lang=='ar'?(''):('italic')}}">
                            {{__('requests.buy-course')}}
                        </button>
                        <button type="button" class="secondary-btn" onclick="closeModal('offerModal')">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="fixed z-50 inset-0 hidden overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true" id="lessonModal">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-primary-150 dark:bg-gray-400 rounded p-4 md:p-8 shadow-2xl w-full lg:w-3/4 h-56 sm:h-screen md:h-[400px] xl:h-[512px]">
                <!-- Modal content -->
                <div class="flex w-full flex-row-reverse">
                    <button onclick="closeModal('lessonModal')">
                        <x-heroicon-o-x-mark class="w-6 h-6 text-gray-700 dark:text-white"/>
                    </button>
                </div>
                <div class="relative w-full h-full">
                    <iframe 
                        id="lesson-frame" 
                        class="lesson-iframe"
                        src="" 
                        frameborder="0" allow="autoplay; fullscreen;" 
                        title="">
                    </iframe>
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
    .lesson-iframe {
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
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.add('opacity-20');
        navigation.classList.add('opacity-20');
    }
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.remove('opacity-20');
        navigation.classList.remove('opacity-20');
    }
    function openLessonModal(video_url) {
        const modal = document.getElementById('lessonModal');
        modal.classList.remove('hidden');

        const iframe = document.getElementById('lesson-frame');
        iframe.src = `https://player.vimeo.com/video/${video_url}?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479`;

        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.add('opacity-20');
        navigation.classList.add('opacity-20');
    }
    
    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'none';
    }, 3000);
</script>