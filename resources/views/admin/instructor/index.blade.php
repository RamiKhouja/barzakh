<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12" id="page-container">
        @if ($message = Session::get('success'))
            <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                <div class="ml-3">
                <h3 class="text-sm font-medium text-green-700">{{$message}}</h3>
                </div>
            </div>
        @endif
        <div id="reorderSuccessMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow hidden">
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-700">{{ __('admin.instructors_reordered') }}</h3>
            </div>
        </div>
        <div id="reorderErrorMessage" class="rounded-md bg-red-50 p-4 mb-6 shadow hidden">
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-700">{{ __('admin.reorder_failed') }}</h3>
            </div>
        </div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-full lg:px-12 mx-auto pb-20">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                    <h1 class="text-lg font-semibold leading-6 text-gray-700 dark:text-gray-100">{{ __('admin.instructors_title') }}</h1>
                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-100">
                        {{ __('admin.instructors_description') }}
                    </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a type="button" class="primary-btn" href="{{ route('instructor.create') }}">
                        {{ __('admin.new_instructor') }}
                    </a>
                    </div>
                </div>
                <div class="mt-8 p-8 bg-white dark:bg-gray-400 rounded-2xl shadow-sm">
                    <p class="mb-6 text-sm text-gray-600 dark:text-gray-100">{{ __('admin.drag_to_reorder') }}</p>
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-100">
                            <thead>
                                <tr>
                                <th scope="col" class="table-th">
                                    {{ __('admin.drag') }}
                                </th>
                                <th scope="col" class="table-th"></th>
                                <th scope="col" class="table-th">
                                    {{ __('admin.order') }}
                                </th>
                                <th scope="col" class="table-th">
                                    {{ __('admin.name') }}
                                </th>
                                <th scope="col" class="table-th">
                                    {{ __('admin.name_ar') }}
                                </th>
                                <th scope="col" class="table-th">
                                    {{ __('admin.email') }}
                                </th>
                                <th scope="col" class="table-th">
                                    {{ __('admin.courses') }}
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                    <span class="sr-only">{{ __('admin.actions') }}</span>
                                </th>
                                </tr>
                            </thead>
                            <tbody id="sortableInstructors" class="divide-y divide-gray-300 dark:divide-gray-100">
                            @foreach($instructors as $instructor)
                                <tr draggable="true" data-instructor-id="{{ $instructor->id }}" class="cursor-move transition">
                                    <td class="table-text text-gray-400 dark:text-white select-none align-middle">
                                        <span class="inline-flex items-center justify-center rounded-md border border-gray-200 dark:border-gray-200 px-2 py-1 text-xs font-semibold">
                                            &#9776;
                                        </span>
                                    </td>
                                    <td>
                                    @if($instructor->image) 
                                        <img src="{{ asset( 'pictures/'.$instructor->image ) }}" alt="" class="w-10 h-10 rounded-full object-cover mr-2"/>
                                    @endif
                                    </td>
                                    <td class="table-text order-cell">
                                        {{ $instructor->order }}
                                    </td>
                                    <td class="table-text">
                                        {{ $instructor->getTranslation('firstname', 'en') }} {{ $instructor->getTranslation('lastname', 'en') }}
                                    </td>
                                    <td class="table-text">
                                        {{ $instructor->getTranslation('firstname', 'ar') }} {{ $instructor->getTranslation('lastname', 'ar') }}
                                    </td>
                                    <td class="table-text">
                                        {{ $instructor->email }}
                                    </td>
                                    <td class="table-text">
                                        {{ $instructor->nb_courses }}
                                    </td>
                                    <td class="relative py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 gap-x-2 flex items-center">
                                        <a href="{{ route('admin.instructor.edit', ['instructor' => $instructor->id]) }}" class="text-gray-400 hover:text-primary-500">
                                            <x-zondicon-edit-pencil class="w-4 h-4 text-primary-500 dark:text-white" />
                                        </a>
                                        <button onclick="openModal('{{ $instructor->id }}')">
                                            <x-zondicon-trash class="w-4 h-4 text-gray-400 dark:text-white" />
                                        </button>
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
    <div class="fixed z-50 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="myModal">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white dark:bg-gray-400 rounded p-8 shadow-2xl">
                <!-- Modal content -->
                <h2 class="mb-2 text-base font-semibold text-gray-900 dark:text-gray-100">Are you sure you want to delete this instructor?</h2>
                <form
                    action="{{ route('admin.instructor.delete', ['instructor' => 'instructorId']) }}"
                    data-action-template="{{ route('admin.instructor.delete', ['instructor' => 'instructorId']) }}"
                    method="POST"
                >
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
    function openModal(instructorId) {
        const modal = document.getElementById('myModal');
        const form = modal.querySelector('form');
        form.action = form.dataset.actionTemplate.replace('instructorId', instructorId);
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

    function hideMessage(messageId) {
        const message = document.getElementById(messageId);

        if (!message || message.classList.contains('hidden')) {
            return;
        }

        setTimeout(() => {
            message.classList.add('hidden');
        }, 3000);
    }

    hideMessage('successMessage');

    const sortableInstructors = document.getElementById('sortableInstructors');
    const reorderUrl = "{{ route('admin.instructor.reorder') }}";
    const csrfToken = "{{ csrf_token() }}";
    const reorderSuccessMessage = document.getElementById('reorderSuccessMessage');
    const reorderErrorMessage = document.getElementById('reorderErrorMessage');
    let draggedRow = null;
    let isSavingOrder = false;

    function refreshOrderCells() {
        Array.from(sortableInstructors.querySelectorAll('tr')).forEach((row, index) => {
            row.querySelector('.order-cell').textContent = index + 1;
        });
    }

    function toggleMessage(element, shouldShow) {
        if (!element) {
            return;
        }

        element.classList.toggle('hidden', !shouldShow);
    }

    async function persistOrder() {
        if (isSavingOrder) {
            return;
        }

        isSavingOrder = true;
        toggleMessage(reorderSuccessMessage, false);
        toggleMessage(reorderErrorMessage, false);

        const instructorIds = Array.from(sortableInstructors.querySelectorAll('tr')).map((row) => row.dataset.instructorId);

        try {
            const response = await fetch(reorderUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ instructors: instructorIds }),
            });

            if (!response.ok) {
                throw new Error('Failed to save order');
            }

            toggleMessage(reorderSuccessMessage, true);
            hideMessage('reorderSuccessMessage');
        } catch (error) {
            toggleMessage(reorderErrorMessage, true);
            hideMessage('reorderErrorMessage');
        } finally {
            isSavingOrder = false;
        }
    }

    sortableInstructors.querySelectorAll('tr').forEach((row) => {
        row.addEventListener('dragstart', () => {
            draggedRow = row;
            row.classList.add('opacity-50');
        });

        row.addEventListener('dragend', () => {
            row.classList.remove('opacity-50');
            draggedRow = null;
            sortableInstructors.querySelectorAll('tr').forEach((tableRow) => {
                tableRow.classList.remove('border-t-2', 'border-primary-500');
            });
        });

        row.addEventListener('dragover', (event) => {
            event.preventDefault();

            if (!draggedRow || draggedRow === row) {
                return;
            }

            const rowBounds = row.getBoundingClientRect();
            const shouldInsertBefore = event.clientY < rowBounds.top + (rowBounds.height / 2);

            sortableInstructors.insertBefore(draggedRow, shouldInsertBefore ? row : row.nextSibling);
            refreshOrderCells();
        });

        row.addEventListener('drop', async (event) => {
            event.preventDefault();
            refreshOrderCells();
            await persistOrder();
        });
    });
</script>
