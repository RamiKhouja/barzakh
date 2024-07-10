<x-app-layout>
    <div class="bg-primary-100 py-12" id="page-container">
    <div class="md:hidden h-20"></div>
        @if ($message = Session::get('success'))
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl mx-auto">
            <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                <div class="ml-3">
                <h3 class="text-sm font-medium text-green-700">{{$message}}</h3>
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-full lg:px-12 mx-auto">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center mb-8">
                    <div class="sm:flex-auto">
                        <h1 class="text-lg font-semibold leading-6 text-gray-700">Requests</h1>
                        <p class="mt-2 text-sm text-gray-700">
                            A list of all the requests in your website.
                        </p>
                    </div>
                </div>
                @foreach($courses as $course)
                <div class="rounded-lg bg-white shadow px-4 py-6 mb-4">
                    <div class="flex gap-x-4 items-center px-6">
                        <img src="{{ asset( 'pictures/'.$course->image ) }}" alt="" class="w-16 h-10 rounded">
                        <div class="flex flex-col">
                            <p class="text-lg text-gray-700">{{$course->title_en}} - {{$course->title_ar}}</p>
                            <p class="text-gray-500">
                                {{$course->nb_offers}} {{$course->nb_offers == 1 ? ('offer') : ('offers')}}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300" id="course-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="table-th">
                                        User
                                    </th>
                                    <th scope="col" class="table-th">
                                        Message
                                    </th>
                                    <th scope="col" class="table-th">
                                        Created
                                    </th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0 text-end">
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                            @foreach($course->requests as $request)
                                <tr>
                                    <td class="table-text">
                                        {{ $request->user->firstname }} {{ $request->user->lastname }}
                                    </td>
                                    <td class="table-text">
                                        {{ $request->message }}
                                    </td>
                                    <td class="table-text">
                                        {{ substr($request->created_at, 0, 10) }}
                                    </td>
                                    <td class="table-text">
                                        <div class="flex gap-x-2 items-center justify-end">
                                            <button type="button" onclick="openApproveModal('{{ $request->id }}')" {{$course->nb_offers == 0 ? ('disabled') : ('')}} class="inline-flex disabled:bg-gray-200 items-center gap-x-1.5 rounded-md bg-green-600 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-700">
                                                <x-heroicon-s-check-circle class="h-5 w-5 text-white" />
                                                Approve
                                            </button>
                                            <button type="button" onclick="openModal('{{ $request->id }}')" class="inline-flex items-center gap-x-1.5 rounded-md bg-red-500 px-2 py-1 text-sm font-semibold text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-700">
                                                <x-heroicon-s-x-circle class="h-5 w-5 text-white" />
                                                Reject
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="fixed z-50 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="myModal">
    <!-- <div id="myModal" class="hidden fixed z-10 inset-0 overflow-y-auto shadow-2xl"> -->
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded p-8 shadow-2xl">
                <!-- Modal content -->
                <h2 class="mb-2 text-base font-semibold text-gray-900">Are you sure you want to reject this request?</h2>
                <form action="{{ route('admin.request.reject', ['courseRequest' => 'requestId']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="primary-btn">Reject</button>
                    <button type="button" class="secondary-btn" onclick="closeModal()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <div class="fixed z-50 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="approveModal">
    <!-- <div id="myModal" class="hidden fixed z-10 inset-0 overflow-y-auto shadow-2xl"> -->
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded p-8 shadow-2xl">
                <!-- Modal content -->
                <h2 class="mb-2 text-base font-semibold text-gray-900">Are you sure you want to approve this request?</h2>
                <form action="{{ route('admin.request.approve', ['courseRequest' => 'requestId']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="primary-btn">Approve</button>
                    <button type="button" class="secondary-btn" onclick="closeApproveModal()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    function openModal(requestId) {
        const modal = document.getElementById('myModal');
        const form = modal.querySelector('form');
        form.action = form.action.replace('requestId', requestId);
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

    function openApproveModal(requestId) {
        const modal = document.getElementById('approveModal');
        const form = modal.querySelector('form');
        form.action = form.action.replace('requestId', requestId);
        modal.classList.remove('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.add('opacity-20');
        navigation.classList.add('opacity-20');
    }

    function closeApproveModal() {
        const modal = document.getElementById('approveModal');
        modal.classList.add('hidden');
        const container = document.getElementById('page-container');
        const navigation = document.getElementById('navigation');
        container.classList.remove('opacity-20');
        navigation.classList.remove('opacity-20');
    }

    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'none';
    }, 3000);
</script>