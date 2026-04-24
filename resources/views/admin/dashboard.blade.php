<x-admin-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div x-data="{ activeTab: 'visibility' }" class="space-y-6">
                <div class="flex justify-center w-full flex-wrap gap-2">
                    <div class="flex w-fit flex-wrap gap-2 rounded-3xl bg-white p-2 shadow-sm dark:bg-gray-400">
                        <button
                            type="button"
                            @click="activeTab = 'visibility'"
                            :class="activeTab === 'visibility' ? 'bg-primary-600 text-white shadow-sm dark:bg-gray-500' : 'text-gray-600 hover:bg-primary-50 dark:text-gray-100 dark:hover:bg-stone/60'"
                            class="rounded-2xl px-5 py-2.5 text-sm font-semibold transition"
                        >
                            {{ __('admin.visibility') }}
                        </button>
                        <button
                            type="button"
                            @click="activeTab = 'sales'"
                            :class="activeTab === 'sales' ? 'bg-primary-600 text-white shadow-sm dark:bg-gray-500' : 'text-gray-600 hover:bg-primary-50 dark:text-gray-100 dark:hover:bg-stone/60'"
                            class="rounded-2xl px-5 py-2.5 text-sm font-semibold transition"
                        >
                            {{ __('admin.sales') }}
                        </button>
                        <button
                            type="button"
                            @click="activeTab = 'content'"
                            :class="activeTab === 'content' ? 'bg-primary-600 text-white shadow-sm dark:bg-gray-500' : 'text-gray-600 hover:bg-primary-50 dark:text-gray-100 dark:hover:bg-stone/60'"
                            class="rounded-2xl px-5 py-2.5 text-sm font-semibold transition"
                        >
                            {{ __('admin.content') }}
                        </button>
                    </div>
                </div>

                <div x-show="activeTab === 'visibility'" x-cloak class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    <div x-data="{ period: 'total' }" class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_visitors_total') }}</p>
                                <p
                                    x-show="period === 'total'"
                                    class="mt-2 text-sm text-gray-600 dark:text-gray-100"
                                >{{ __('admin.stats_visitors_total_desc') }}</p>
                                <p
                                    x-show="period === 'month'"
                                    class="mt-2 text-sm text-gray-600 dark:text-gray-100"
                                >{{ __('admin.stats_visitors_month_desc') }}</p>
                            </div>
                            <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                                <x-heroicon-s-eye class="h-6 w-6 text-primary-700 dark:text-white" />
                            </div>
                        </div>
                        <div class="mt-6 inline-flex rounded-2xl bg-primary-50 p-1 dark:bg-stone/60">
                            <button
                                type="button"
                                @click="period = 'total'"
                                :class="period === 'total' ? 'bg-white text-primary-700 shadow-sm dark:bg-gray-500 dark:text-white' : 'text-gray-600 dark:text-gray-200'"
                                class="rounded-xl px-4 py-2 text-sm font-medium transition"
                            >
                                {{ __('admin.stats_period_total') }}
                            </button>
                            <button
                                type="button"
                                @click="period = 'month'"
                                :class="period === 'month' ? 'bg-white text-primary-700 shadow-sm dark:bg-gray-500 dark:text-white' : 'text-gray-600 dark:text-gray-200'"
                                class="rounded-xl px-4 py-2 text-sm font-medium transition"
                            >
                                {{ __('admin.stats_period_month') }}
                            </button>
                        </div>
                        <p x-show="period === 'total'" class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['visitors_total']) }}</p>
                        <p x-show="period === 'month'" class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['visitors_month']) }}</p>
                    </div>

                    <div x-data="{ period: 'total' }" class="rounded-3xl bg-white p-6 shadow-sm dark:bg-gray-400">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_unique_users_total') }}</p>
                                <p
                                    x-show="period === 'total'"
                                    class="mt-2 text-sm text-gray-600 dark:text-gray-100"
                                >{{ __('admin.stats_unique_users_total_desc') }}</p>
                                <p
                                    x-show="period === 'month'"
                                    class="mt-2 text-sm text-gray-600 dark:text-gray-100"
                                >{{ __('admin.stats_unique_users_month_desc') }}</p>
                            </div>
                            <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                                <x-heroicon-s-computer-desktop class="h-6 w-6 text-primary-700 dark:text-white" />
                            </div>
                        </div>
                        <div class="mt-6 inline-flex rounded-2xl bg-primary-50 p-1 dark:bg-stone/60">
                            <button
                                type="button"
                                @click="period = 'total'"
                                :class="period === 'total' ? 'bg-white text-primary-700 shadow-sm dark:bg-gray-500 dark:text-white' : 'text-gray-600 dark:text-gray-200'"
                                class="rounded-xl px-4 py-2 text-sm font-medium transition"
                            >
                                {{ __('admin.stats_period_total') }}
                            </button>
                            <button
                                type="button"
                                @click="period = 'month'"
                                :class="period === 'month' ? 'bg-white text-primary-700 shadow-sm dark:bg-gray-500 dark:text-white' : 'text-gray-600 dark:text-gray-200'"
                                class="rounded-xl px-4 py-2 text-sm font-medium transition"
                            >
                                {{ __('admin.stats_period_month') }}
                            </button>
                        </div>
                        <p x-show="period === 'total'" class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['unique_users_total']) }}</p>
                        <p x-show="period === 'month'" class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['unique_users_month']) }}</p>
                    </div>
                </div>

                <div x-show="activeTab === 'sales'" x-cloak class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
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
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_payments') }}</p>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_payments_desc') }}</p>
                            </div>
                            <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                                <x-heroicon-s-credit-card class="h-6 w-6 text-primary-700 dark:text-white" />
                            </div>
                        </div>
                        <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['payments']) }}</p>
                    </div>
                </div>

                <div x-show="activeTab === 'content'" x-cloak class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
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
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('admin.stats_instructors') }}</p>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.stats_instructors_desc') }}</p>
                            </div>
                            <div class="rounded-2xl bg-primary-100 p-3 dark:bg-stone">
                                <x-heroicon-s-users class="h-6 w-6 text-primary-700 dark:text-white" />
                            </div>
                        </div>
                        <p class="mt-6 text-4xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['instructors']) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
