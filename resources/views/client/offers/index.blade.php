<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-5xl mx-auto mt-8 md:-mt-20 mb-72">
            @if ($message = Session::get('success'))
                <div id="successMessage" class="rounded-md bg-green-50 p-4 mb-6 shadow">
                    <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-700">{{$message}}</h3>
                    </div>
                </div>
            @endif
            <div class="flex justify-center md:mt-20 mb-20">
                <p class="text-lg md:text-xl lg:text-3xl text-primary-600 dark:text-white font-bold">{{__('requests.the-offers')}}</p>
            </div>
            <div class="sm:grid sm:grid-cols-2 gap-6 lg:grid-cols-3 xl:grid-cols-4" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}">
                @foreach($courses as $course)
                <div class="item">
                    <x-course :course="$course" :status=null :completed=null/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>