<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12" id="page-container">
        @if ($message = Session::get('success'))
            <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl mx-auto">
                <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-green-700">{{ $message }}</h3>
                    </div>
                </div>
            </div>
        @endif

        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-full lg:px-12 mx-auto">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-lg font-semibold leading-6 text-gray-700 dark:text-gray-100">{{ __('admin.service_requests_title') }}</h1>
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-100">
                            {{ __('admin.service_requests_description') }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 p-8 bg-white dark:bg-gray-400 rounded-2xl shadow-sm">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-100">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-th">{{ __('admin.client') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.email') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.phone') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.service') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.request_description') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.created') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-300 dark:divide-gray-100">
                                    @foreach($serviceRequests as $serviceRequest)
                                        <tr>
                                            <td class="table-text">
                                                {{ trim($serviceRequest->firstname.' '.$serviceRequest->lastname) ?: $serviceRequest->firstname }}
                                            </td>
                                            <td class="table-text">{{ $serviceRequest->email }}</td>
                                            <td class="table-text">{{ $serviceRequest->phone ?: '-' }}</td>
                                            <td class="table-text">
                                                <a href="{{ route('admin.service.show', ['service' => $serviceRequest->service->id]) }}" class="text-primary-700 dark:text-primary-100 underline">
                                                    {{ app()->getLocale() === 'ar' ? $serviceRequest->service->title_ar : $serviceRequest->service->title_en }}
                                                </a>
                                            </td>
                                            <td class="table-text max-w-sm truncate">{{ $serviceRequest->description }}</td>
                                            <td class="table-text">{{ $serviceRequest->created_at?->format('Y-m-d H:i') }}</td>
                                            <td class="table-text">
                                                <a href="{{ route('admin.service-requests.show', ['serviceRequest' => $serviceRequest->id]) }}" class="inline-flex items-center gap-x-1 text-primary-700 dark:text-white">
                                                    <x-heroicon-s-eye class="w-4 h-4" />
                                                    <span>{{ __('admin.view_page') }}</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-8">
                                {{ $serviceRequests->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
