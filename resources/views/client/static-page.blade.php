<x-app-layout>
    <?php $lang = app()->getLocale(); ?>

    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="mx-auto max-w-xs px-4 pb-24 pt-28 sm:max-w-sm md:max-w-3xl lg:max-w-5xl lg:px-8">
            <div class="rounded-[2rem] bg-white/80 p-8 shadow-sm dark:bg-gray-600/40 md:p-12" dir="{{ $lang === 'ar' ? 'rtl' : 'ltr' }}">
                <p class="mb-8 text-center text-3xl font-semibold text-bordo dark:text-white md:text-4xl lg:text-5xl">
                    {{ $page->title($lang) }}
                </p>

                <div class="prose prose-lg max-w-none whitespace-pre-line text-gray-700 dark:prose-invert dark:text-gray-100 {{ $lang === 'ar' ? 'text-right' : 'text-left' }}">
                    {{ $page->content($lang) }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
