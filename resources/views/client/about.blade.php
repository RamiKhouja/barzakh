<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="relative mt-20 md:mt-0">
            <img src="{{ asset('pictures/about/main.png') }}" class="w-full" alt=""/>
            <div class="absolute top-1 lg:top-4 inset-0 flex justify-center">
                <img src="{{ asset('pictures/global/logo-main.png') }}" class="w-12 h-12 lg:w-36 lg:h-36" alt=""/>
            </div>
        </div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl mx-auto mt-8 md:-mt-20 mb-24 scroll-smooth">
            <div class="md:h-16 lg:h-28"></div>
            <div class="flex justify-center mt-10 {{$lang=='ar'?('mb-8'):('mb-6')}}">
                <p class="text-4xl md:text-5xl lg:text-7xl text-bordo dark:text-white font-medium">{{ $about->content('title', $lang) }}</p>
            </div>
            <p class="text-center text-xl lg:text-2xl text-gray-500 dark:text-primary-100 font-normal mb-6">{{ $about->content('subtitle', $lang) }}</p>
            <p class="text-center text-2xl md:text-3xl lg:text-4xl text-bordo dark:text-white font-medium">{{ $about->content('folder', $lang) }}</p>
            <div class="text-center">
                <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3  lg:w-64" alt=""/>
            </div>

            <div class="fade-section mt-20" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8 md:w-11" alt=""/>
                    <p class="text-3xl md:text-4xl lg:text-5xl text-bordo dark:text-white font-bold mb-8 lg:mb-12">{{ $about->content('meaning', $lang) }}</p>
                </div>
                <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm" style="line-height: 1.625; !important;">{{ $about->content('paragraph1', $lang) }}</p>
                <div class="text-center mt-16">
                    <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                    <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3 lg:w-64" alt=""/>
                </div>
            </div>
            <div class="fade-section mt-20" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-center text-3xl md:text-4xl lg:text-6xl text-bordo dark:text-white font-bold mb-12">{{ $about->content('components', $lang) }}</p>
                <div class="mt-12 lg:mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="rounded-full flex flex-col justify-center bg-primary-200 w-72 h-72 mx-auto">
                        <div class="text-center">
                            <p class="text-4xl text-bordo font-medium mb-4" style="font-family: MehrNastaliq">{{ $about->content('lab', 'ar') }}</p>
                            <p class="text-lg md:text-2xl lg:text-xl text-gray-700 font-medium uppercase mb-4" style="font-family: PT Serif">{{ $about->content('lab', 'en') }}</p>
                        </div>
                    </div>
                    <div class="rounded-full flex flex-col justify-center bg-primary-200 w-72 h-72 mx-auto">
                        <div class="text-center">
                            <p class="text-4xl text-bordo font-medium mb-4" style="font-family: MehrNastaliq">{{ $about->content('world_views', 'ar') }}</p>
                            <p class="text-lg md:text-2xl lg:text-xl text-gray-700 font-medium uppercase mb-4" style="font-family: PT Serif">{{ $about->content('world_views', 'en') }}</p>
                        </div>
                    </div>
                    <div class="rounded-full flex flex-col justify-center bg-primary-200 w-72 h-72 mx-auto">
                        <div class="text-center">
                            <p class="text-4xl lg:text-4xl text-bordo font-medium mb-4" style="font-family: MehrNastaliq">{{ $about->content('store', 'ar') }}</p>
                            <p class="text-lg md:text-2xl lg:text-xl text-gray-700 font-medium uppercase mb-4" style="font-family: PT Serif">{{ $about->content('store', 'en') }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-16">
                    <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                    <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3 lg:w-64" alt=""/>
                </div>
            </div>
            <div class="fade-section mt-20" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="lg:flex lg:items-end">
                    <div class="flex justify-center lg:justify-end w-80 relative">
                        <div class="absolute md:hidden">
                            <img src="{{ asset('pictures/about/circle1.png') }}" class="w-2/3 mx-auto" alt="">
                        </div>
                        <div class="text-center mt-8 lg:mt-4 md:mt-0 mb-12">
                            <p class="text-2xl lg:text-4xl text-bordo dark:text-white font-medium mb-4" style="font-family: MehrNastaliq">{{ $about->content('lab', 'ar') }}</p>
                            <p class="text-lg lg:text-xl text-gray-700 dark:text-white font-medium uppercase" style="font-family: PT Serif">{{ $about->content('lab', 'en') }}</p>
                        </div>
                    </div>
                    <div class="relative lg:w-full">
                        <div class="hidden absolute md:block">
                            <img src="{{ asset('pictures/about/circle1.png') }}" class="w-full h-full {{$lang == 'ar' ? ('') : ('scale-x-[-1]')}}" alt="">
                        </div>
                        <div class="md:px-28 md:pt-28 lg:px-32 lg:pt-32">
                            <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm">{{ $about->content('lab_description', $lang) }}</p>
                            <div class="p-4 mt-4">
                                <div class="flex items-start gap-x-2 mb-2">
                                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                                    <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{ $about->content('lab_1', $lang) }}</p>
                                </div>
                                <div class="flex items-start gap-x-2 mb-2">
                                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                                    <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{ $about->content('lab_2', $lang) }}</p>
                                </div>
                                <div class="flex items-start gap-x-2 mb-2">
                                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                                    <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{ $about->content('lab_3', $lang) }}</p>
                                </div>
                                <div class="flex items-start gap-x-2">
                                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                                    <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{ $about->content('lab_4', $lang) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="fade-section mt-32 relative" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="hidden absolute md:block md:w-4/5 md:-top-4 {{$lang == 'ar' ? ('md:-left-8') : ('md:-right-8')}}">
                    <img src="{{ asset('pictures/about/circle2.png') }}" class="w-full {{$lang == 'ar' ? ('') : ('scale-x-[-1]')}}" alt="">
                </div>
                <div class="absolute md:hidden -top-12 {{$lang == 'ar' ? ('-left-4') : ('-right-4')}}">
                    <img src="{{ asset('pictures/about/circle2.png') }}" class="w-2/3 mx-auto" alt="">
                </div>
                <div class="flex justify-center lg:justify-start mb-12">
                    <div class="text-center">
                        <p class="text-2xl lg:text-4xl text-bordo dark:text-white font-medium mb-4" style="font-family: MehrNastaliq">{{ $about->content('world_views', 'ar') }}</p>
                        <p class="text-lg lg:text-xl text-gray-700 dark:text-white font-medium uppercase mb-4" style="font-family: PT Serif">{{ $about->content('world_views', 'en') }}</p>
                    </div>
                </div>
                <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm lg:max-w-4xl">{{ $about->content('world_views_description', $lang) }}</p>
                <div class="px-4 mt-6 mb-8">
                    <div class="flex items-start gap-x-2 mb-2">
                        <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                        <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{ $about->content('view_1', $lang) }}</p>
                    </div>
                    <div class="flex items-start gap-x-2 mb-2">
                        <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                        <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{ $about->content('view_2', $lang) }}</p>
                    </div>
                    <div class="flex items-start gap-x-2">
                        <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                        <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{ $about->content('view_3', $lang) }}</p>
                    </div>
                </div>
                <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm lg:max-w-4xl">{{ $about->content('world_views_description_2', $lang) }}</p>
            </div>
            <div class="fade-section mt-40 relative" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="absolute md:hidden -top-12">
                    <img src="{{ asset('pictures/about/circle3.png') }}" class="w-4/5 mx-auto" alt="">
                </div>
                <div class="flex justify-center lg:justify-start mb-12 lg:mx-24">
                    <div class="text-center">
                        <p class="text-2xl lg:text-4xl text-bordo dark:text-white font-medium mb-4" style="font-family: MehrNastaliq">{{ $about->content('store', 'ar') }}</p>
                        <p class="text-lg lg:text-xl text-gray-700 dark:text-white font-medium uppercase mb-4" style="font-family: PT Serif">{{ $about->content('store', 'en') }}</p>
                    </div>
                </div>
                <div class="flex justify-center mt-8">
                    <p class="lg:max-w-xl text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm text-justify ">{{ $about->content('store_description', $lang) }}</p>
                </div>
                <div class="hidden absolute md:block md:-top-12 {{$lang == 'ar' ? ('md:-left-8') : ('md:-right-8')}}">
                    <img src="{{ asset('pictures/about/circle3.png') }}" class="w-full {{$lang == 'ar' ? ('') : ('scale-x-[-1]')}}" alt="">
                </div>
            </div>
            <div class="fade-section mt-20 lg:mt-56 relative" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-center text-2xl lg:text-6xl text-bordo dark:text-white font-semibold mb-10">{{ $about->content('environment', $lang) }}</p>
                <img src="{{ asset('pictures/about/fields.png') }}" class="w-full md:w-3/5 mx-auto" alt="">
            </div>
            <div class="fade-section mt-16 lg:mt-32" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8 lg:w-11" alt=""/>
                    <p class="text-2xl lg:text-4xl text-bordo dark:text-white font-bold mb-4 lg:mb-8">{{ $about->content('barzakh_project', $lang) }}</p>
                </div>
                <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-12" style="line-height: 1.625; !important;">{{ $about->content('project_description', $lang) }}</p>

                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_1', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_1_desc', $lang) }}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_2', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_2_desc', $lang) }}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_3', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_3_desc', $lang) }}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_4', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_4_desc', $lang) }}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_5', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_5_desc', $lang) }}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_6', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_6_desc', $lang) }}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_7', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_7_desc', $lang) }}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_8', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_8_desc', $lang) }}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{ $about->content('project_9', $lang) }}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{ $about->content('project_9_desc', $lang) }}</p>
                
            </div>

            <div class="fade-section mt-20 lg:mt-32" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="text-center">
                    <!-- <p class="lg:max-w-xl mx-auto text-2xl lg:text-5xl text-bordo dark:text-white font-bold mb-16" style="line-height: 1.5; !important;">{{ $about->content('join_us', $lang) }}</p>
                    <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm font-medium mb-16" style="line-height: 1.5; !important;">{{ $about->content('join_description', $lang) }}</p> -->
                    <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                    <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3 lg:w-64" alt=""/>
                </div>
            </div>

            <div class="fade-section mt-16 lg:mt-32" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                
                <p class="text-center lg:max-w-xl mx-auto text-2xl lg:text-5xl text-bordo dark:text-white font-bold mb-8" style="line-height: 1.5; !important;">{{ $about->content('why_invest', $lang) }}</p>
                <div class="flex items-start gap-x-3 mb-8">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8" alt=""/>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-100 font-ibm font-medium" style="line-height: 1.5; !important;">{{ $about->content('why_invest_1', $lang) }}</p>
                </div>
                <div class="flex items-start gap-x-3 mb-8">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8" alt=""/>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-100 font-ibm font-medium" style="line-height: 1.5; !important;">{{ $about->content('why_invest_2', $lang) }}</p>
                </div>
                <div class="flex items-start gap-x-3 mb-8">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8" alt=""/>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-100 font-ibm font-medium" style="line-height: 1.5; !important;">{{ $about->content('why_invest_3', $lang) }}</p>
                </div>
                <div class="flex items-start gap-x-3 mb-12">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8" alt=""/>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-100 font-ibm font-medium" style="line-height: 1.5; !important;">{{ $about->content('commitment', $lang) }}</p>
                </div>
                <p class="text-center mx-auto text-2xl lg:text-4xl text-bordo dark:text-white font-semibold" style="line-height: 1.5; !important;">{{ $about->content('last', $lang) }}</p>
                <div class="text-center mt-2">
                    <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                    <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3 lg:w-64" alt=""/>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sections = document.querySelectorAll('.fade-section');

            if (!sections.length) {
                return;
            }

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    entry.target.classList.toggle('is-visible', entry.isIntersecting);
                });
            }, {
                threshold: 0.2,
                rootMargin: '-10% 0px -10% 0px',
            });

            sections.forEach((section) => observer.observe(section));
        });
    </script>

    <style>
        .fade-section {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.7s ease, transform 0.7s ease;
            will-change: opacity, transform;
        }

        .fade-section.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</x-app-layout>
