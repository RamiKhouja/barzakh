<x-app-layout>
    <div class="bg-primary-100 py-12" id="page-container">
        @if ($message = Session::get('success'))
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl mx-auto">
            <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                <div class="ml-3">
                <h3 class="text-sm font-medium text-green-700">{{$message}}</h3>
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-full lg:px-12 mx-auto flex justify-center">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                    <h1 class="text-lg font-semibold leading-6 text-gray-700">Courses</h1>
                    <p class="mt-2 text-sm text-gray-700">
                        A list of all the categories in your website.
                    </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a type="button" class="primary-btn" href="{{ route('admin.course.create') }}">
                        New Course
                    </a>
                    </div>
                </div>
                <div class="mt-8 p-8 bg-white rounded-2xl shadow-sm">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300" id="course-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="table-th"></th>
                                    <th scope="col" class="table-th">
                                        Title
                                    </th>
                                    <th scope="col" class="table-th">
                                        Title Ar
                                    </th>
                                    <th scope="col" class="table-th">
                                        Instructor
                                    </th>
                                    <th scope="col" class="table-th">
                                        Price
                                    </th>
                                    <th scope="col" class="table-th">
                                        Discount
                                    </th>
                                    <th scope="col" class="table-th">
                                        Created
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                            @foreach($courses as $course)
                                <tr>
                                    <td>
                                        @if($course->image) 
                                            <img src="{{asset($course->image)}}" alt="" class="w-12 h-10 rounded-sm object-cover mr-2"/>
                                        @endif
                                    </td>
                                    <td class="table-text">
                                        {{ $course->title_en }}
                                    </td>
                                    <td class="table-text">
                                        {{ $course->title_ar }}
                                    </td>
                                    <td class="table-text">
                                        {{ $course->instructor->firstname}} {{ $course->instructor->lastname}}
                                    </td>
                                    <td class="table-text">
                                        {{ $course->price }} $
                                    </td>
                                    <td class="table-text">
                                    @if($course->discount_price)
                                        {{ $course->discount_price }} $
                                    @endif
                                    </td>
                                    <td class="table-text">
                                        {{ substr($course->created_at, 0, 10) }}
                                    </td>
                                    <td class="relative py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 space-x-4 flex items-center">
                                        <a href="{{ route('admin.course.edit', ['course' => $course->id]) }}">
                                            <x-zondicon-edit-pencil class="w-4 h-4 text-primary-500" />
                                        </a>
                                        <button onclick="openModal('{{ $course->id }}')">
                                            <x-zondicon-trash class="w-4 h-4 text-gray-400" />
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
    <!-- <div id="myModal" class="hidden fixed z-10 inset-0 overflow-y-auto shadow-2xl"> -->
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded p-8 shadow-2xl">
                <!-- Modal content -->
                <h2 class="mb-2 text-base font-semibold text-gray-900">Are you sure you want to delete this course?</h2>
                <form action="{{ route('admin.course.delete', ['course' => 'courseId']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="primary-btn">Delete</button>
                    <button type="button" class="secondary-btn" onclick="closeModal()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function openModal(courseId) {
        const modal = document.getElementById('myModal');
        const form = modal.querySelector('form');
        form.action = form.action.replace('courseId', courseId);
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

    // setTimeout(() => {
    //     const successMessage = document.getElementById('successMessage');
    //     successMessage.style.display = 'none';
    // }, 3000);
</script>