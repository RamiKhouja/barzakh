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
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                    <h1 class="text-lg font-semibold leading-6 text-gray-700">Offers</h1>
                    <p class="mt-2 text-sm text-gray-700">
                        A list of all the offers in your website.
                    </p>
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
                                        Course
                                    </th>
                                    <th scope="col" class="table-th">
                                        User
                                    </th>
                                    <th scope="col" class="table-th">
                                        Qty
                                    </th>
                                    <th scope="col" class="table-th">
                                        Amount
                                    </th>
                                    <th scope="col" class="table-th">
                                        Status
                                    </th>
                                    <th scope="col" class="table-th">
                                        Created
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300">
                            @foreach($offers as $offer)
                                <tr>
                                    <td>
                                        @if($offer->course->image) 
                                            <img src="{{ asset( 'pictures/'.$offer->course->image ) }}" alt="" class="w-12 h-9 rounded-sm object-cover mr-2"/>
                                        @endif
                                    </td>
                                    <td class="table-text">
                                        <div>
                                            <p>{{ $offer->course->title_en }}</p>
                                            <p>{{ $offer->course->title_ar }}</p>
                                        </div>
                                    </td>
                                    <td class="table-text">
                                        {{ $offer->user->firstname }} {{ $offer->user->lastname }}
                                    </td>
                                    <td class="table-text">
                                        {{ $offer->qty }}
                                    </td>
                                    <td class="table-text">
                                        ${{ $offer->amount }}
                                    </td>
                                    <td class="table-text">
                                        <span class="inline-flex items-center rounded-lg 
                                            {{$offer->status=='pending' ? ('bg-blue-100 text-blue-700') : ($offer->status=='successful' ? ('bg-green-100 text-green-700') : ('bg-red-100 text-red-700'))}}
                                            px-2 py-0.5 text-sm font-medium">
                                            {{ ucfirst($offer->status) }}
                                        </span>  
                                    </td>
                                    <td class="table-text">
                                        {{ substr($offer->created_at, 0, 10) }}
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
