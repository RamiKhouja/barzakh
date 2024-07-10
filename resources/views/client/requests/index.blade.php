<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-lg md:max-w-xl lg:max-w-5xl mx-auto mt-8 md:-mt-20 mb-72">
            @if ($message = Session::get('success'))
                <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                    <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-700">{{$message}}</h3>
                    </div>
                </div>
            @endif
            <div class="flex justify-center mb-8 md:my-20">
                <p class="text-lg md:text-xl lg:text-3xl text-primary-600 dark:text-white font-bold">{{__('requests.the-requests')}}</p>
            </div>
            <ul role="list" class="divide-y divide-primary-300 overflow-hidden bg-primary-150 dark:bg-stone shadow rounded-xl">
            @foreach($courses as $data)
                <li class="relative md:flex justify-between gap-x-6 p-4 hover:bg-primary-200 dark:hover:bg-gray-500 sm:px-6" dir="{{$lang=='ar' ? 'rtl' : 'ltr'}}">
                    <div class="flex min-w-0 gap-x-4 items-center">
                        <img src="{{ asset( 'pictures/'.$data['course']->image ) }}" alt="Slide 1" class="w-16 h-10 rounded">
                        <div class="min-w-0 flex-auto">
                            <p class="text-base font-semibold text-gray-700 hover:text-bordo dark:text-primary-50 dark:hover:text-red-500 {{$lang=='ar' ? 'text-right' : ''}}">
                                <a href="{{ route('course.showUrl', ['url'=>$data['course']->url]) }}" target="_blank">
                                    {{ $lang=='ar' ? $data['course']->title_ar : $data['course']->title_en }}
                                </a>
                            </p>
                            <p class="flex text-sm text-gray-500 dark:text-primary-100">
                                @if($data['count']>1)
                                {{ $data['count'] }} {{__('requests.requests')}}
                                @else
                                {{__('requests.1-req')}}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-x-4 mt-2 md:mt-0">
                        <form method="POST" action="{{ route('offer.store') }}">
                        @csrf
                        @php
                            $price = $data['course']->is_discount ? $data['course']->discount_price : $data['course']->price;
                        @endphp
                        <div class="flex gap-x-4 sm:gap-x-16 items-center">
                            <p class="text-lg leading-6 text-bordo dark:text-primary-50 font-semibold">
                                ${{ $price }}
                            </p>
                            <input type="hidden" name="price" value="{{$price}}"/>
                            <input type="hidden" name="course_id" value="{{$data['course']->id}}"/>
                            <div class="w-24 flex gap-x-4 items-center dark:text-primary-100">
                                <label htmlFor="title">
                                    {{__('requests.qty')}}
                                </label>
                                <div>
                                    <input
                                        type="number"
                                        name="qty"
                                        id="qty"
                                        class="form-input h-7"
                                        placeholder="Qty"
                                        min=1
                                        value=1
                                    />
                                </div>
                            </div>
                            <button type="submit" class="rounded-full bg-bordo dark:bg-primary-50 px-4 py-1 text-xs md:text-sm font-medium text-primary-50 dark:text-gray-500 shadow-sm hover:bg-bordo dark:hover:bg-bordo dark:hover:text-primary-50 {{$lang=='ar'?(''):('italic')}}">
                                {{__('requests.buy-course')}}
                            </button>
                        </div>
                        </form>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
<script>
    setTimeout(() => {
        const successMessage = document.getElementById('successMessage');
        successMessage.style.display = 'none';
    }, 3000);
</script>
