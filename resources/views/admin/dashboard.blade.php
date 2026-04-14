<x-admin-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_courses') }}</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_courses_desc') }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                            <x-heroicon-s-academic-cap class="h-6 w-6 text-primary-700 dark:text-white" />
                        </div>
                    </div>
                    <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['courses']) }}</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_clients') }}</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_clients_desc') }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                            <x-heroicon-s-user-group class="h-6 w-6 text-primary-700 dark:text-white" />
                        </div>
                    </div>
                    <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['clients']) }}</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_instructors') }}</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_instructors_desc') }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                            <x-heroicon-s-users class="h-6 w-6 text-primary-700 dark:text-white" />
                        </div>
                    </div>
                    <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['instructors']) }}</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_users') }}</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_users_desc') }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                            <x-heroicon-s-identification class="h-6 w-6 text-primary-700 dark:text-white" />
                        </div>
                    </div>
                    <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['users']) }}</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_payments') }}</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_payments_desc') }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                            <x-heroicon-s-credit-card class="h-6 w-6 text-primary-700 dark:text-white" />
                        </div>
                    </div>
                    <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['payments']) }}</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_revenue') }}</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_revenue_desc') }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                            <x-heroicon-s-banknotes class="h-6 w-6 text-primary-700 dark:text-white" />
                        </div>
                    </div>
                    <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">${{ number_format((float) $stats['revenue'], 2) }}</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_visitors_total') }}</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_visitors_total_desc') }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                            <x-heroicon-s-eye class="h-6 w-6 text-primary-700 dark:text-white" />
                        </div>
                    </div>
                    <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['visitors_total']) }}</p>
                </div>

                <div class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_visitors_month') }}</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_visitors_month_desc') }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                            <x-heroicon-s-calendar-days class="h-6 w-6 text-primary-700 dark:text-white" />
                        </div>
                    </div>
                    <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['visitors_month']) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
