<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-2xl font-semibold text-gray-700 dark:text-white">{{ __('admin.search_results') }}</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-100">
                    {{ __('admin.search_results_for') }}: <span class="font-semibold">{{ $query }}</span>
                </p>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">
                <section class="rounded-2xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <h2 class="mb-4 text-lg font-semibold text-gray-700 dark:text-white">{{ __('admin.matching_courses') }}</h2>

                    @if ($courses->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-100">{{ __('admin.no_courses_found') }}</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($courses as $course)
                                <div class="flex items-center justify-between gap-4 rounded-2xl border border-primary-200 bg-primary-50 p-4 dark:border-gray-700 dark:bg-stone">
                                    <div class="min-w-0">
                                        <p class="truncate font-semibold text-gray-700 dark:text-white">{{ $course->title_en }}</p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-100">{{ $course->title_ar }}</p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-100">{{ $course->instructor?->firstname }} {{ $course->instructor?->lastname }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.course.show', ['course' => $course->id]) }}" class="secondary-btn">{{ __('admin.view_course') }}</a>
                                        <a href="{{ route('admin.course.edit', ['course' => $course->id]) }}" class="primary-btn">{{ __('admin.edit_course') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>

                <section class="rounded-2xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <h2 class="mb-4 text-lg font-semibold text-gray-700 dark:text-white">{{ __('admin.matching_instructors') }}</h2>

                    @if ($instructors->isEmpty())
                        <p class="text-sm text-gray-600 dark:text-gray-100">{{ __('admin.no_instructors_found') }}</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($instructors as $instructor)
                                <div class="flex items-center justify-between gap-4 rounded-2xl border border-primary-200 bg-primary-50 p-4 dark:border-gray-700 dark:bg-stone">
                                    <div class="min-w-0">
                                        <p class="truncate font-semibold text-gray-700 dark:text-white">
                                            {{ $instructor->getTranslation('firstname', 'en') }} {{ $instructor->getTranslation('lastname', 'en') }}
                                        </p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-100">
                                            {{ $instructor->getTranslation('firstname', 'ar') }} {{ $instructor->getTranslation('lastname', 'ar') }}
                                        </p>
                                        <p class="truncate text-sm text-gray-500 dark:text-gray-100">{{ $instructor->email }}</p>
                                    </div>
                                    <a href="{{ route('admin.instructor.edit', ['instructor' => $instructor->id]) }}" class="primary-btn">{{ __('admin.view_instructor') }}</a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-admin-layout>
