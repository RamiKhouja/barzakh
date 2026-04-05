<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12" id="page-container">
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl lg:px-12 mx-auto">
            <div class="rounded-3xl bg-white dark:bg-gray-400 shadow-sm overflow-hidden">
                @if($service->image)
                    <img src="{{ asset('pictures/'.$service->image) }}" alt="{{ $service->title_en }}" class="h-72 w-full object-cover">
                @endif

                <div class="p-8">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                        <div>
                            <p class="text-3xl font-semibold text-gray-700 dark:text-gray-100">{{ $service->title_en }}</p>
                            <p class="text-xl text-gray-500 dark:text-gray-100 mt-2">{{ $service->title_ar }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-100 mt-4">{{ $service->url }}</p>
                        </div>

                        <div class="text-left md:text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-100">{{ __('admin.price') }}</p>
                            <p class="text-2xl font-semibold text-bordo dark:text-white mt-1">${{ number_format((float) $service->price, 2) }}</p>
                            <div class="mt-4 flex flex-wrap gap-3 md:justify-end">
                                <a href="{{ route('service.showUrl', ['url' => $service->url]) }}" class="secondary-btn">{{ __('admin.view_page') }}</a>
                                <a href="{{ route('admin.service.edit', ['service' => $service->id]) }}" class="primary-btn">{{ __('admin.actions') }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                        <div class="rounded-2xl bg-primary-100 dark:bg-gray-700 p-6">
                            <p class="text-sm font-semibold text-primary-700 dark:text-primary-100 mb-3">{{ __('admin.english') }}</p>
                            <p class="text-gray-700 dark:text-gray-100 whitespace-pre-line">{{ $service->description_en ?: '-' }}</p>
                        </div>
                        <div class="rounded-2xl bg-primary-100 dark:bg-gray-700 p-6">
                            <p class="text-sm font-semibold text-primary-700 dark:text-primary-100 mb-3">{{ __('admin.arabic') }}</p>
                            <p class="text-gray-700 dark:text-gray-100 whitespace-pre-line" dir="rtl">{{ $service->description_ar ?: '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('admin.service-requests.index') }}" class="text-sm text-primary-700 dark:text-primary-100 underline">
                            {{ __('nav.Service-Requests') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
