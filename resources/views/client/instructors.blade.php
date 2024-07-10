<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        
            <div class="w-full max-w-full px-4 lg:px-20 py-32 sm:max-w-md md:max-w-screen-xl mx-auto">
                <p class="text-2xl md:text-3xl lg:text-5xl text-primary-700 dark:text-white font-black  mb-20 text-center {{$lang=='ar'?(''):('italic')}}">
                    {{__('welcome.our-instructors')}}
                </p>
                <div class="mt-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 xl:grid-cols-5 gap-6">
                        @foreach($instructors as $instructor)
                        <div class="group relative instructor rounded-2xl">
                            <a href="{{ route('instructor.showUrl', ['url' => $instructor->url]) }}">
                                <img class="h-auto max-w-full rounded-2xl" src="{{ asset( 'pictures/'.$instructor->image ) }}" alt="">
                                <div class="group-hover:visible rounded-b-2xl group-hover:translate-y-0 group-hover:opacity-100 instructor-details h-1/2 sm:h-[40%] md:h-1/2 lg:h-[40%] top-1/2 sm:top-[60%] md:top-1/2 lg:top-[60%] bg-gradient-to-t from-stone via-transparent to-transparent text-white py-4 px-3">
                                    <div class="{{$lang == 'ar' ? ('text-right') : ('')}}">
                                        <p class="{{$lang == 'ar' ? ('text-xl font-semibold') : ('text-base lg:text-lg font-semibold')}}">{{$instructor->firstname}} {{$instructor->lastname}}</p>
                                        <p class="text-xs lg:text-sm font-medium text-gray-50" 
                                            dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}"
                                            title="{{$instructor->short_desc}}"
                                        >
                                            <?php
                                                $nb = $lang=='ar' ? 4 : 3;
                                                $desc = $instructor->short_desc;
                                                $arr = explode(" ",$instructor->short_desc);
                                                if(count($arr)>$nb) {
                                                    $desc= implode(" ",array_slice($arr, 0, $nb)).'...';
                                                }
                                            ?>
                                            {{ $desc }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <x-footer/>

    <style>
        .instructor-details {
            position: absolute;
            visibility: hidden;
            width: 100%;
            opacity: 0;
            transition: opacity 0.25s ease-in-out;
        }
    </style>
</x-app-layout>