<x-admin-layout>
    <div class="bg-primary-100 dark:bg-gray-700 py-12" id="page-container">
        @if ($message = Session::get('success'))
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl mx-auto">
            <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                <div class="ml-3">
                <h3 class="text-sm font-medium text-green-700">{{$message}}</h3>
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl lg:px-12 mx-auto flex justify-center">
            <div class="sm:flex w-full sm:gap-x-12 text-center sm:text-left">
                <div class="w-full sm:w-1/2 md:w-1/3">
                    <img src="{{ asset( 'pictures/'.$course->image ) }}" alt="" class="w-full rounded-lg object-cover mr-2"/>
                </div>
                <div class="block mt-4 sm:mt-0">
                    <p class="text-4xl font-medium text-gray-700 dark:text-white">{{$course->title_en}}</p>
                    <div class="md:flex md:flex-wrap md:gap-x-4 mt-4 space-y-2 md:space-y-0">
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-s-banknotes class="h-4 w-4 dark:text-white"/>
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold {{$course->is_discount ? ('line-through'):('')}}">${{$course->price}} USD</p>
                        </div>
                        @if($course->is_discount)
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-s-arrow-trending-down class="h-4 w-4 dark:text-white"/>
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                ${{$course->discount_price}} USD
                            </p>
                        </div>
                        <div class="flex gap-x-1 items-center">
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                DISC {{$course->discount}}%
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="md:flex md:flex-wrap md:gap-x-4 mt-2 md:mt-4 space-y-2 md:space-y-0">
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-s-chart-bar class="h-4 w-4 dark:text-white"/>
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">{{ucfirst($course->level)}}</p>
                        </div>
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-m-play-circle class="h-4 w-4 dark:text-white"/>
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                {{$course->nb_lessons}} Lessons ({{ gmdate("H:i:s", $course->duration) }})
                            </p>
                        </div>
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-s-document class="h-4 w-4 dark:text-white"/>
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                {{$course->nb_files > 0 ? $course->nb_files : ('No')}} Files
                            </p>
                        </div>
                    </div>
                    <div class="md:flex md:flex-wrap md:gap-x-4 mt-2 md:mt-4 space-y-2 md:space-y-0">
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-m-users class="h-4 w-4 dark:text-white"/>
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                {{$course->nb_subscription > 0 ? $course->nb_subscription : ('No')}} Students
                            </p>
                        </div>
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-s-eye class="h-4 w-4 dark:text-white"/>
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                {{$course->nb_visits > 0 ? $course->nb_visits : ('No')}} Visits
                            </p>
                        </div>
                    </div>
                    <div class="md:flex md:flex-wrap md:gap-x-4 mt-2 md:mt-4 space-y-2 md:space-y-0">
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-s-speaker-wave class="h-4 w-4 dark:text-white"/>
                            <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                {{ $course->language ? __('course.' . $course->language) : __('course.no-translation') }}
                            </p>
                        </div>
                        <div class="flex gap-x-1 items-center">
                            <x-heroicon-s-language class="h-4 w-4 dark:text-white"/>
                            @if($course->translations != null)
                                <?php $i = 0; ?>
                                @foreach(json_decode($course->translations) as $trans)
                                <?php $i++; ?>
                                <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                    {{ucfirst($trans)}} 
                                </p>
                                @if($i < count(json_decode($course->translations)))
                                    <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">.</p>
                                @endif
                                @endforeach
                            @else
                                <p class="text-gray-400 dark:text-gray-50 text-sm font-semibold">
                                    No Translations
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl lg:px-12 mx-auto mt-12">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                <h1 class="text-lg font-semibold leading-6 text-gray-700 dark:text-gray-100">{{ __('admin.lessons_title') }}</h1>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-100">
                    {{ __('admin.course_lessons_description') }}
                </p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a type="button" class="primary-btn" href="{{ route('admin.lesson.create', ['course' => $course->id]) }}">
                    {{ __('admin.new_lesson') }}
                </a>
                </div>
            </div>
            <div class="mt-8 p-8 bg-white dark:bg-gray-400 rounded-2xl shadow-sm">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-100">
                        <thead>
                            <tr>
                            <th scope="col" class="table-th">
                                {{ __('admin.lesson_number') }}
                            </th>
                            <th scope="col" class="table-th">
                                {{ __('admin.title') }}
                            </th>
                            <th scope="col" class="table-th">
                                {{ __('admin.title_ar') }}
                            </th>
                            <th scope="col" class="table-th">
                                {{ __('admin.duration') }}
                            </th>
                            <th scope="col" class="table-th">
                                {{ __('admin.free') }}
                            </th>
                            <th scope="col" class="table-th">
                                {{ __('admin.visible') }}
                            </th>
                            <th scope="col" class="table-th">
                                {{ __('admin.actions') }}
                            </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-100">
                        @foreach($lessons as $lesson)
                            <tr>
                                <td class="table-text">
                                    Lesson {{ $lesson->number }}
                                </td>
                                <td class="table-text">
                                    {{ $lesson->title_en }}
                                </td>
                                <td class="table-text">
                                    {{ $lesson->title_ar }}
                                </td>
                                <td class="table-text">
                                    {{ gmdate("H:i:s", $lesson->duration) }}
                                </td>
                                <td class="table-text">
                                    {{ $lesson->is_free ? ('Yes') : ('No') }}
                                </td>
                                <td class="table-text">
                                    {{ $lesson->is_visible ? ('Yes') : ('No') }}
                                </td>
                                <td class="relative p-4 text-right text-sm font-medium sm:pr-0 gap-x-2 flex items-center">
                                    <a>
                                        <x-heroicon-s-eye class="w-4 h-4 text-primary-700 dark:text-white" />
                                    </a>
                                    <a href="{{ route('admin.lesson.edit', ['lesson' => $lesson->id]) }}">
                                        <x-zondicon-edit-pencil class="w-4 h-4 text-primary-500 dark:text-white" />
                                    </a>
                                    <button onclick="openModal('{{ $lesson->id }}')">
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
    <div class="fixed z-50 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="myModal">
    <!-- <div id="myModal" class="hidden fixed z-10 inset-0 overflow-y-auto shadow-2xl"> -->
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white dark:bg-gray-400 rounded p-8 shadow-2xl">
                <!-- Modal content -->
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
    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'none';
    }, 3000);

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
</script>
