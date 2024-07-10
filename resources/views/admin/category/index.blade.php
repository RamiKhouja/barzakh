<x-app-layout>
    <div class="bg-primary-100 py-12" id="page-container">
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
                    <h1 class="text-lg font-semibold leading-6 text-gray-700">Categories</h1>
                    <p class="mt-2 text-sm text-gray-700">
                        A list of all the categories in your website.
                    </p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a type="button" class="primary-btn" href="{{ route('admin.category.create') }}">
                        New Category
                    </a>
                    </div>
                </div>
                <div class="mt-8 p-8 bg-white rounded-2xl shadow-sm">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-300">
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
                                    Domain
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
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        @if($category->image) 
                                            <img src="{{$category->imageLink}}" alt="" class="w-12 h-10 rounded-sm object-cover mr-2"/>
                                        @endif
                                    </td>
                                    <td class="table-text">
                                        {{ $category->title_en }}
                                    </td>
                                    <td class="table-text">
                                        {{ $category->title_ar }}
                                    </td>
                                    <td class="table-text">
                                        {{ $category->field->getTranslation('title', 'en') }}
                                    </td>
                                    <td class="table-text">
                                        {{ $category->url }}
                                    </td>
                                    <td class="relative py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <a href="{{ route('admin.category.edit', ['category' => $category->id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                            Edit<span class="sr-only"></span>
                                        </a>
                                        <button onclick="openModal('{{ $category->id }}')"
                                            class="secondary-btn"
                                        >Delete</button>
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
                <h2 class="mb-2 text-base font-semibold text-gray-900">Are you sure you want to delete this category?</h2>
                <form action="{{ route('admin.category.delete', ['category' => 'categoryId']) }}" method="POST">
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
    function openModal(categoryId) {
        const modal = document.getElementById('myModal');
        const form = modal.querySelector('form');
        form.action = form.action.replace('categoryId', categoryId);
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
        successMessage.style.display = 'none';
    }, 3000);
</script>
