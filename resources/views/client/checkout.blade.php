<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-screen-sm lg:max-w-4xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-56">
            <p>You're gonna pay this course {{$course->title_en}}</p>
        </div>
    </div>
</x-app-layout>