<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12" id="page-container">
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl lg:px-12 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 rounded-3xl bg-white dark:bg-gray-400 shadow-sm p-8">
                    <p class="text-2xl font-semibold text-gray-700 dark:text-gray-100">{{ __('admin.request_information') }}</p>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.created') }}</p>
                            <p class="mt-2 text-gray-700 dark:text-gray-100">{{ $serviceRequest->created_at?->format('Y-m-d H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.service') }}</p>
                            <a href="{{ route('admin.service.show', ['service' => $serviceRequest->service->id]) }}" class="mt-2 inline-block text-primary-700 dark:text-primary-100 underline">
                                {{ app()->getLocale() === 'ar' ? $serviceRequest->service->title_ar : $serviceRequest->service->title_en }}
                            </a>
                        </div>
                    </div>

                    <div class="mt-8">
                        <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.request_description') }}</p>
                        <div class="mt-2 rounded-2xl bg-primary-100 dark:bg-gray-700 p-6 text-gray-700 dark:text-gray-100 whitespace-pre-line">{{ $serviceRequest->description }}</div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-3xl bg-white dark:bg-gray-400 shadow-sm p-8">
                        <p class="text-xl font-semibold text-gray-700 dark:text-gray-100">{{ __('admin.client_information') }}</p>
                        <div class="mt-6 space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.client') }}</p>
                                <p class="mt-1 text-gray-700 dark:text-gray-100">{{ trim($serviceRequest->firstname.' '.$serviceRequest->lastname) ?: $serviceRequest->firstname }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.email') }}</p>
                                <p class="mt-1 text-gray-700 dark:text-gray-100">{{ $serviceRequest->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.phone') }}</p>
                                <p class="mt-1 text-gray-700 dark:text-gray-100">{{ $serviceRequest->phone ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-white dark:bg-gray-400 shadow-sm p-8">
                        <p class="text-xl font-semibold text-gray-700 dark:text-gray-100">{{ __('admin.service_information') }}</p>
                        <div class="mt-6 space-y-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.title') }}</p>
                                <p class="mt-1 text-gray-700 dark:text-gray-100">{{ $serviceRequest->service->title_en }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.title_ar') }}</p>
                                <p class="mt-1 text-gray-700 dark:text-gray-100">{{ $serviceRequest->service->title_ar }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.price') }}</p>
                                <p class="mt-1 text-gray-700 dark:text-gray-100">${{ number_format((float) $serviceRequest->service->price, 2) }}</p>
                            </div>
                            <div class="pt-2">
                                <a href="{{ route('service.showUrl', ['url' => $serviceRequest->service->url]) }}" class="text-primary-700 dark:text-primary-100 underline">
                                    {{ __('admin.view_page') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
