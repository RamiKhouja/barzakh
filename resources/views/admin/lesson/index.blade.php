<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12" id="page-container">
        @if ($message = Session::get('success'))
            <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-700">{{ $message }}</h3>
                </div>
            </div>
        @endif

        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-full lg:px-12 mx-auto">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-lg font-semibold leading-6 text-gray-700 dark:text-gray-100">{{ __('admin.lessons_title') }}</h1>
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-100">
                            {{ __('admin.lessons_description') }}
                        </p>
                    </div>
                </div>

                <div class="mt-8 rounded-2xl bg-white dark:bg-gray-400 p-8 shadow-sm">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-100">
                                <thead>
                                    <tr>
                                        <th scope="col" class="table-th">{{ __('admin.title') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.title_ar') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.course') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.number') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.visibility') }}</th>
                                        <th scope="col" class="table-th">{{ __('admin.free') }}</th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                            <span class="sr-only">{{ __('admin.actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-300 dark:divide-gray-100">
                                    @foreach($lessons as $lesson)
                                        <tr>
                                            <td class="table-text">{{ $lesson->title_en }}</td>
                                            <td class="table-text">{{ $lesson->title_ar }}</td>
                                            <td class="table-text">
                                                <a href="{{ route('admin.course.show', ['course' => $lesson->course_id]) }}" class="text-primary-700 hover:text-primary-500 dark:text-white">
                                                    {{ $lesson->course?->title_en }}
                                                </a>
                                            </td>
                                            <td class="table-text">{{ $lesson->number }}</td>
                                            <td class="table-text">{{ $lesson->is_visible ? 'Visible' : 'Hidden' }}</td>
                                            <td class="table-text">{{ $lesson->is_free ? 'Yes' : 'No' }}</td>
                                            <td class="table-text">
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('admin.lesson.edit', ['lesson' => $lesson->id]) }}">
                                                        <x-zondicon-edit-pencil class="h-4 w-4 text-primary-500 dark:text-white" />
                                                    </a>
                                                    <button onclick="openModal('{{ $lesson->id }}')">
                                                        <x-zondicon-trash class="h-4 w-4 text-gray-400 dark:text-white" />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="mt-8">
                                {{ $lessons->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="myModal">
        <div class="flex min-h-screen items-center justify-center px-4">
            <div class="rounded bg-white dark:bg-gray-400 p-8 shadow-2xl">
                <h2 class="mb-2 text-base font-semibold text-gray-900 dark:text-gray-100">Are you sure you want to delete this lesson?</h2>
                <form action="{{ route('admin.lesson.delete', ['lesson' => 'lessonId']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="primary-btn">Delete</button>
                    <button type="button" class="secondary-btn" onclick="closeModal()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
<script>
    function openModal(lessonId) {
        const modal = document.getElementById('myModal');
        const form = modal.querySelector('form');
        form.action = form.action.replace('lessonId', lessonId);
        modal.classList.remove('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.add('opacity-20');
        navigation.classList.add('opacity-20');
    }

    function closeModal() {
        const modal = document.getElementById('myModal');
        modal.classList.add('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.remove('opacity-20');
        navigation.classList.remove('opacity-20');
    }

    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
</script>
