<x-admin-layout>
    <div class="bg-primary-100 py-12 dark:bg-gray-700" id="page-container">
        @if ($message = Session::get('success'))
            <div id="successMessage" class="mb-6 rounded-md bg-green-50 p-4 shadow">
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-700">{{ $message }}</h3>
                </div>
            </div>
        @endif

        <div class="mx-auto max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-full lg:px-12">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-lg font-semibold leading-6 text-gray-700 dark:text-gray-100">{{ __('admin.static_pages_title') }}</h1>
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-100">{{ __('admin.static_pages_description') }}</p>
                    </div>
                </div>

                <div class="mt-8 rounded-2xl bg-white p-8 shadow-sm dark:bg-gray-400">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-100">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-th">{{ __('admin.title') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.title_ar') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.slug') }}</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                            <span class="sr-only">{{ __('admin.actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-300 dark:divide-gray-100">
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td class="table-text">{{ $page->title_en }}</td>
                                            <td class="table-text">{{ $page->title_ar }}</td>
                                            <td class="table-text">{{ $page->slug }}</td>
                                            <td class="relative py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                <a href="{{ route('static-pages.show', $page->slug) }}" target="_blank" class="mr-3 text-primary-500 dark:text-white">
                                                    {{ __('admin.view_page') }}
                                                </a>
                                                <a href="{{ route('admin.static-pages.edit', $page) }}" class="text-gray-400 hover:text-primary-500">
                                                    <x-zondicon-edit-pencil class="h-4 w-4 text-primary-500 dark:text-white" />
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-8">
                                {{ $pages->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');

        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
</script>
