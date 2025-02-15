<x-app-layout>
    <div class="bg-primary-100 py-12 h-screen">
    <div class="md:hidden h-20"></div>
        @if ($message = Session::get('success'))
            <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                <div class="ml-3">
                <h3 class="text-sm font-medium text-green-700">{{$message}}</h3>
                </div>
            </div>
        @endif
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-full lg:px-12 mx-auto">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                    <h1 class="text-lg font-semibold leading-6 text-gray-700">Study Domains</h1>
                    <p class="mt-2 text-sm text-gray-700">
                        A list of all the domains in your website.
                    </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a type="button" class="primary-btn" href="{{ route('field.create') }}">
                        New Domain
                    </a>
                    </div>
                </div>
                <div class="mt-8 p-8 bg-white rounded-2xl shadow-sm">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                <th scope="col" class="table-th">
                                    Title
                                </th>
                                <th scope="col" class="table-th">
                                    Title Ar
                                </th>
                                <th scope="col" class="table-th">
                                    Subtitle
                                </th>
                                <th scope="col" class="table-th">
                                    Subtitle Ar
                                </th>
                                <th scope="col" class="table-th">
                                    URL
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">Edit</span>
                                </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                            @foreach($fields as $field)
                                <tr>
                                    <td class="table-text">
                                        {{ $field->getTranslation('title', 'en') }}
                                    </td>
                                    <td class="table-text">
                                        {{ $field->getTranslation('title', 'ar') }}
                                    </td>
                                    <td class="table-text">
                                        {{ $field->getTranslation('subtitle', 'en') }}
                                    </td>
                                    <td class="table-text">
                                        {{ $field->getTranslation('subtitle', 'ar') }}
                                    </td>
                                    <td class="table-text">
                                        {{ $field->url }}
                                    </td>
                                    <td class="relative py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                    <a href="{{ route('field.edit', ['field' => $field->id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                        Edit<span class="sr-only">, {person.name}</span>
                                    </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'none';
    }, 3000);
</script>