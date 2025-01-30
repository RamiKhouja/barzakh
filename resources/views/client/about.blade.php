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
                <p class="text-4xl md:text-5xl lg:text-7xl text-bordo dark:text-white font-medium">{{__('about.title')}}</p>
            </div>
            <p class="text-center text-xl lg:text-2xl text-gray-500 dark:text-primary-100 font-normal mb-6">{{__('about.subtitle')}}</p>
            <p class="text-center text-2xl md:text-3xl lg:text-4xl text-bordo dark:text-white font-medium">{{__('about.folder')}}</p>
            <div class="text-center">
                <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3  lg:w-64" alt=""/>
            </div>

            <div class="mt-20" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8 md:w-11" alt=""/>
                    <p class="text-3xl md:text-4xl lg:text-5xl text-bordo dark:text-white font-bold mb-8 lg:mb-12">{{__('about.meaning')}}</p>
                </div>
                <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm" style="line-height: 1.625; !important;">{{__('about.paragraph1')}}</p>
                <div class="text-center mt-16">
                    <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                    <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3 lg:w-64" alt=""/>
                </div>
            </div>
            <div class="mt-20" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-center text-3xl md:text-4xl lg:text-6xl text-bordo dark:text-white font-bold mb-12">{{__('about.components')}}</p>
                <div class="mt-12 lg:mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="rounded-full flex flex-col justify-center bg-primary-200 w-72 h-72 mx-auto">
                        <div class="text-center">
                            <p class="text-lg md:text-2xl lg:text-4xl text-bordo dark:text-white font-semibold mb-8" style="font-family: Noto Nastaliq Urdu">مخبر برزخ</p>
                            <p class="text-lg md:text-2xl lg:text-xl text-gray-700 font-medium uppercase mb-4" style="font-family: PT Serif">Barzakh Lab</p>
                        </div>
                    </div>
                    <div class="rounded-full flex flex-col justify-center bg-primary-200 w-72 h-72 mx-auto">
                        <div class="text-center">
                            <p class="text-lg md:text-2xl lg:text-4xl text-bordo font-semibold mb-8" style="font-family: Noto Nastaliq Urdu">برزخ لرؤى العالم</p>
                            <p class="text-lg md:text-2xl lg:text-xl text-gray-700 font-medium uppercase mb-4" style="font-family: PT Serif">For World Views</p>
                        </div>
                    </div>
                    <div class="rounded-full flex flex-col justify-center bg-primary-200 w-72 h-72 mx-auto">
                        <div class="text-center">
                            <p class="text-lg md:text-2xl lg:text-4xl text-bordo font-semibold mb-8" style="font-family: Noto Nastaliq Urdu">دكان برزخ</p>
                            <p class="text-lg md:text-2xl lg:text-xl text-gray-700 font-medium uppercase mb-4" style="font-family: PT Serif">Concept Store</p>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-16">
                    <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                    <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3 lg:w-64" alt=""/>
                </div>
            </div>
            <div class="mt-20" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="lg:flex lg:items-end">
                    <div class="flex justify-center lg:justify-end w-80 relative">
                        <div class="absolute md:hidden">
                            <img src="{{ asset('pictures/about/circle1.png') }}" class="w-2/3 mx-auto" alt="">
                        </div>
                        <div class="text-center mt-8 lg:mt-4 md:mt-0 mb-12">
                            <p class="text-2xl lg:text-4xl text-bordo dark:text-white font-semibold mb-8" style="font-family: Noto Nastaliq Urdu">مخبر برزخ</p>
                            <p class="text-lg lg:text-xl text-gray-700 dark:text-white font-medium uppercase" style="font-family: PT Serif">Barzakh Lab</p>
                        </div>
                    </div>
                    <div class="relative lg:w-full">
                        <div class="hidden absolute md:block">
                            <img src="{{ asset('pictures/about/circle1.png') }}" class="w-full h-full {{$lang == 'ar' ? ('') : ('scale-x-[-1]')}}" alt="">
                        </div>
                        <div class="md:px-28 md:pt-28 lg:px-32 lg:pt-32">
                            <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm">{{__('about.lab-description')}}</p>
                            <div class="p-4 mt-4">
                                <div class="flex items-start gap-x-2 mb-2">
                                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                                    <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{__('about.lab-1')}}</p>
                                </div>
                                <div class="flex items-start gap-x-2 mb-2">
                                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                                    <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{__('about.lab-2')}}</p>
                                </div>
                                <div class="flex items-start gap-x-2 mb-2">
                                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                                    <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{__('about.lab-3')}}</p>
                                </div>
                                <div class="flex items-start gap-x-2">
                                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                                    <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{__('about.lab-4')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-32 relative" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="hidden absolute md:block md:w-4/5 md:-top-4 {{$lang == 'ar' ? ('md:-left-8') : ('md:-right-8')}}">
                    <img src="{{ asset('pictures/about/circle2.png') }}" class="w-full {{$lang == 'ar' ? ('') : ('scale-x-[-1]')}}" alt="">
                </div>
                <div class="absolute md:hidden -top-12 {{$lang == 'ar' ? ('-left-4') : ('-right-4')}}">
                    <img src="{{ asset('pictures/about/circle2.png') }}" class="w-2/3 mx-auto" alt="">
                </div>
                <div class="flex justify-center lg:justify-start mb-12">
                    <div class="text-center">
                        <p class="text-2xl lg:text-4xl text-bordo dark:text-white font-semibold mb-8" style="font-family: Noto Nastaliq Urdu">برزخ لرؤى العالم</p>
                        <p class="text-lg lg:text-xl text-gray-700 dark:text-white font-medium uppercase mb-4" style="font-family: PT Serif">For World Views</p>
                    </div>
                </div>
                <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm lg:max-w-4xl">{{__('about.world-views-description')}}</p>
                <div class="px-4 mt-6 mb-8">
                    <div class="flex items-start gap-x-2 mb-2">
                        <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                        <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{__('about.view-1')}}</p>
                    </div>
                    <div class="flex items-start gap-x-2 mb-2">
                        <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                        <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{__('about.view-2')}}</p>
                    </div>
                    <div class="flex items-start gap-x-2">
                        <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-6" alt=""/>
                        <p class="text-base md:text-lg lg:text-xl text-gray-700 dark:text-gray-100 font-ibm">{{__('about.view-3')}}</p>
                    </div>
                </div>
                <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm lg:max-w-4xl">{{__('about.world-views-description-2')}}</p>
            </div>
            <div class="mt-40 relative" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="absolute md:hidden -top-12">
                    <img src="{{ asset('pictures/about/circle3.png') }}" class="w-4/5 mx-auto" alt="">
                </div>
                <div class="flex justify-center lg:justify-start mb-12 lg:mx-24">
                    <div class="text-center">
                        <p class="text-2xl lg:text-4xl text-bordo dark:text-white font-semibold mb-8" style="font-family: Noto Nastaliq Urdu">دكّان برزخ</p>
                        <p class="text-lg lg:text-xl text-gray-700 dark:text-white font-medium uppercase mb-4" style="font-family: PT Serif">Concept Store</p>
                    </div>
                </div>
                <div class="flex justify-center mt-8">
                    <p class="lg:max-w-xl text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm text-justify ">{{__('about.store-description')}}</p>
                </div>
                <div class="hidden absolute md:block md:-top-12 {{$lang == 'ar' ? ('md:-left-8') : ('md:-right-8')}}">
                    <img src="{{ asset('pictures/about/circle3.png') }}" class="w-full {{$lang == 'ar' ? ('') : ('scale-x-[-1]')}}" alt="">
                </div>
            </div>
            <div class="mt-20 lg:mt-56 relative" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-center text-2xl lg:text-6xl text-bordo dark:text-white font-semibold mb-10">{{__('about.environment')}}</p>
                <img src="{{ asset('pictures/about/fields.png') }}" class="w-full md:w-3/5 mx-auto" alt="">
            </div>
            <div class="mt-16 lg:mt-32" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8 lg:w-11" alt=""/>
                    <p class="text-2xl lg:text-4xl text-bordo dark:text-white font-bold mb-4 lg:mb-8">{{__('about.barzakh-project')}}</p>
                </div>
                <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-12" style="line-height: 1.625; !important;">{{__('about.project-description')}}</p>

                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-1')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-1-desc')}}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-2')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-2-desc')}}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-3')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-3-desc')}}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-4')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-4-desc')}}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-5')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-5-desc')}}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-6')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-6-desc')}}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-7')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-7-desc')}}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-8')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-8-desc')}}</p>
                <div class="flex items-start gap-x-3">
                    <img src="{{ asset('pictures/about/dot-outline.png') }}" class="w-7" alt=""/>
                    <p class="text-xl lg:text-3xl text-bordo dark:text-white font-bold mb-2">{{__('about.project-9')}}</p>
                </div>
                <p class="{{$lang == 'ar' ? ('pr-10') : ('pl-10')}} lg:px-16 text-base md:text-lg lg:text-2xl text-gray-700 dark:text-gray-100 font-medium text-justify font-ibm lg:max-w-screen-lg mb-8" style="line-height: 1.625; !important;">{{__('about.project-9-desc')}}</p>
                
            </div>

            <div class="mt-20 lg:mt-32" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="text-center">
                    <p class="lg:max-w-xl mx-auto text-2xl lg:text-5xl text-bordo dark:text-white font-bold mb-16" style="line-height: 1.5; !important;">{{__('about.join-us')}}</p>
                    <p class="text-lg md:text-xl lg:text-3xl text-gray-700 dark:text-gray-100 font-ibm font-medium mb-16" style="line-height: 1.5; !important;">{{__('about.join-description')}}</p>
                    <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                    <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3 lg:w-64" alt=""/>
                </div>
            </div>

            <div class="mt-16 lg:mt-32" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                
                <p class="text-center lg:max-w-xl mx-auto text-2xl lg:text-5xl text-bordo dark:text-white font-bold mb-8" style="line-height: 1.5; !important;">{{__('about.why-invest')}}</p>
                <div class="flex items-start gap-x-3 mb-8">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8" alt=""/>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-100 font-ibm font-medium" style="line-height: 1.5; !important;">{{__('about.why-invest-1')}}</p>
                </div>
                <div class="flex items-start gap-x-3 mb-8">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8" alt=""/>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-100 font-ibm font-medium" style="line-height: 1.5; !important;">{{__('about.why-invest-2')}}</p>
                </div>
                <div class="flex items-start gap-x-3 mb-8">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8" alt=""/>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-100 font-ibm font-medium" style="line-height: 1.5; !important;">{{__('about.why-invest-3')}}</p>
                </div>
                <div class="flex items-start gap-x-3 mb-12">
                    <img src="{{ asset('pictures/about/dot-solid.png') }}" class="w-8" alt=""/>
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 dark:text-gray-100 font-ibm font-medium" style="line-height: 1.5; !important;">{{__('about.commitment')}}</p>
                </div>
                <p class="text-center mx-auto text-2xl lg:text-4xl text-bordo dark:text-white font-semibold" style="line-height: 1.5; !important;">{{__('about.last')}}</p>
                <div class="text-center mt-2">
                    <img src="{{ asset('pictures/global/B4.png') }}" class="dark:hidden mx-auto w-2/3 lg:w-64" alt=""/>
                    <img src="{{ asset('pictures/global/B2.png') }}" class="hidden dark:block mx-auto w-2/3 lg:w-64" alt=""/>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const paragraphs = document.querySelectorAll('.paragraph');

            function isInViewport(element) {
                const rect = element.getBoundingClientRect();
                return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                );
            }

            function animateParagraphs() {
                paragraphs.forEach(paragraph => {
                    if (isInViewport(paragraph)) {
                        paragraph.classList.add('animate');
                    }
                });
            }

            animateParagraphs();

            window.addEventListener('scroll', animateParagraphs);
        });
    </script>

    <style>
        .paragraph {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1.5s, transform 1.5s;
        }

        .paragraph.animate {
            opacity: 1;
            transform: translateY(0);
        }

    </style>
</x-app-layout>
