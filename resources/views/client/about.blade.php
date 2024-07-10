<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl mx-auto mt-8 md:-mt-20 mb-72 scroll-smooth">
            <div class="flex mt-8 mb-4 justify-center">
                <img src="{{ asset('pictures/global/logo-main.png') }}" width="170" alt=""/>
            </div>
            <div class="flex justify-center {{$lang=='ar'?('mb-6'):('mb-2')}}">
                <p class="text-lg md:text-xl lg:text-4xl text-bordo dark:text-white font-bold" style="font-family:{{$lang=='ar' ? ('Noto Nastaliq Urdu') : ('Great Vibes')}}">{{__('about.title')}}</p>
            </div>
            <div class="mt-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <div class="mb-20">
                    <p class="font-bold text-bordo dark:text-white text-4xl mb-8">{{__('about.title1')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg ">
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.paragraph1')}}</p>
                    </div>
                </div>
                <div class="mb-20 paragraph">
                    <p class="font-bold text-bordo dark:text-white text-4xl mb-8">{{__('about.title2')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg ">
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.paragraph2')}}</p>
                    </div>
                </div>
                <div class="mb-20 paragraph">
                    <p class="font-bold text-bordo dark:text-white text-3xl mb-8">{{__('about.title3')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg ">
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.paragraph3')}}</p>
                    </div>
                </div>
                <div class="mb-20 ">
                    <p class="font-bold text-bordo dark:text-white text-3xl mb-8 paragraph">{{__('about.goals')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">1. {{__('about.goal1')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.goal1-desc')}}</p>
                    </div>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg mt-10 paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">2. {{__('about.goal2')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.goal2-desc')}}</p>
                    </div>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg mt-10 paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">3. {{__('about.goal3')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.goal3-desc')}}</p>
                    </div>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg mt-10 paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">4. {{__('about.goal4')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.goal4-desc')}}</p>
                    </div>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg mt-10 paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">5. {{__('about.goal5')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.goal5-desc')}}</p>
                    </div>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg mt-10 paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">6. {{__('about.goal6')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.goal6-desc')}}</p>
                    </div>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg mt-10 paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">7. {{__('about.goal7')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.goal7-desc')}}</p>
                    </div>
                </div>
                <div class="mb-20 paragraph">
                    <p class="font-bold text-bordo dark:text-white text-4xl mb-8">{{__('about.title4')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg ">
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.paragraph4')}}</p>
                    </div>
                </div>
                <div class="mb-20 ">
                    <p class="font-bold text-bordo dark:text-white text-3xl mb-8 paragraph">{{__('about.content')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">1. {{__('about.content-1-title')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.content-1-desc')}}</p>
                    </div>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg mt-10 paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">2. {{__('about.content-2-title')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.content-2-desc')}}</p>
                    </div>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg mt-10 paragraph">
                        <p class="text-primary-700 dark:text-white text-2xl font-bold leading-loose text-justify">3. {{__('about.content-3-title')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.content-3-desc')}}</p>
                    </div>
                </div>
                <div class="mb-20 paragraph">
                    <p class="font-bold text-bordo dark:text-white text-4xl mb-8">{{__('about.lab-title')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg ">
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.lab-desc')}}</p>
                    </div>
                </div>
                <div class="mb-20 paragraph">
                    <p class="font-bold text-bordo dark:text-white text-4xl mb-8">{{__('about.store')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg ">
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify mb-10">{{__('about.store-para-1')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.store-para-2')}}</p>
                    </div>
                </div>
                <div class="mb-20 paragraph">
                    <p class="font-bold text-bordo dark:text-white text-4xl mb-8">{{__('about.sospeso-model')}}</p>
                    <div class="bg-primary-200 dark:bg-gray-500 p-8 rounded-lg ">
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify mb-10">{{__('about.sospeso-para-1')}}</p>
                        <p class="text-primary-700 dark:text-white text-2xl leading-loose text-justify">{{__('about.sospeso-para-2')}}</p>
                    </div>
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
