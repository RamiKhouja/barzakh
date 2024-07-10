<?php $lang = app()->getLocale(); ?>
<div class="footer px-8 sm:px-20 md:px-16 lg:px-44 pb-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 sm:gap-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
        <div class="text-center {{$lang == 'ar' ? ('sm:text-right') : ('sm:text-left')}} space-y-2 mx-auto sm:mx-0">
            <img src="{{ asset('pictures/global/logo.png') }}" class="h-16 dark:hidden" alt=""/>
            <img src="{{ asset('pictures/global/logo-white.png') }}" class="h-16 hidden dark:block" alt=""/>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg px-2">{{__('welcome.about-barzakh')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg px-2">{{__('welcome.our-news')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg px-2">{{__('welcome.the-team')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg px-2">{{__('welcome.contact-us')}}</p>
        </div>
        <div class="text-center {{$lang == 'ar' ? ('sm:text-right') : ('sm:text-left')}} space-y-2 mx-auto sm:mx-0">
            <p class="text-primary-700 dark:text-white font-black text-xl">{{__('welcome.discover-more')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg">{{__('welcome.our-courses')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg">{{__('welcome.most-popular-courses')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg">{{__('welcome.subscription-plans')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg">{{__('welcome.our-experts')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg">{{__('welcome.learning-partners')}}</p>
        </div>
        <div class="text-center {{$lang == 'ar' ? ('sm:text-right') : ('sm:text-left')}} space-y-2 mx-auto sm:mx-0">
            <p class="text-primary-700 dark:text-white font-black text-xl">{{__('welcome.barzakh-for-business')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg">{{__('welcome.join-our-experts')}}</p>
            <p class="text-gray-700 dark:text-gray-50 font-medium text-lg">{{__('welcome.train-your-team')}}</p>
        </div>
        <div class="text-center space-y-4 mx-auto">
            <p class="text-gray-700 dark:text-gray-50 font-black text-xl">{{__('welcome.download-app')}}</p>
            <img src="{{ asset('pictures/global/mobile-apps-buttons.png') }}" class="w-64 sm:w-full dark:hidden" alt=""/>
            <img src="{{ asset('pictures/global/mobile-apps-buttons-white.png') }}" class="w-64 sm:w-full hidden dark:block" alt=""/>
        </div>
    </div>
    <div class="pt-24 md:flex md:justify-between md:items-center space-y-4 md:space-y-0 {{$lang == 'ar' ? ('md:flex-row-reverse') : ('')}}">
        <div class="sm:flex sm:space-x-6 space-y-2 sm:space-y-0 sm:justify-center md:justify-normal text-center">
            <p class="text-primary-700 dark:text-white font-medium">{{__('welcome.terms-of-use')}}</p>
            <p class="text-primary-700 dark:text-white font-medium">{{__('welcome.privacy-policy')}}</p>
            <p class="text-primary-700 dark:text-white font-medium">{{__('welcome.help-center')}}</p>
        </div>
        <div class="flex space-x-2 justify-center md:justify-normal dark:hidden">
            <img src="{{ asset('pictures/global/yt.png') }}" class="w-8" alt=""/>
            <img src="{{ asset('pictures/global/fb.png') }}" class="w-8" alt=""/>
            <img src="{{ asset('pictures/global/tw.png') }}" class="w-8" alt=""/>
            <img src="{{ asset('pictures/global/li.png') }}" class="w-8" alt=""/>
        </div>
        <div class="dark:flex space-x-2 justify-center md:justify-normal hidden">
            <img src="{{ asset('pictures/global/yt-white.png') }}" class="w-8" alt=""/>
            <img src="{{ asset('pictures/global/fb-white.png') }}" class="w-8" alt=""/>
            <img src="{{ asset('pictures/global/tw-white.png') }}" class="w-8" alt=""/>
            <img src="{{ asset('pictures/global/li-white.png') }}" class="w-8" alt=""/>
        </div>
    </div>
</div>