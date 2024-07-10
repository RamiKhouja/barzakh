<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-36">
            <div class="my-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-2xl {{$lang == 'ar' ? ('font-medium') : ('font-semibold')}} text-gray-700 dark:text-white mb-6">{{__('profile.the-courses')}}</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 container" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                    @foreach($courses as $course)
                        <x-course :course="$course" :status=null :completed="$course->completed_lessons"/>
                    @endforeach 
                </div>
            </div>
            @if($requested)
            <div class="my-16" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                <p class="text-2xl {{$lang == 'ar' ? ('font-medium') : ('font-semibold')}} text-gray-700 dark:text-white mb-6">{{__('profile.requested-courses')}}</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 container" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                    @foreach($requested as $cr)
                        <x-course :course="$cr->course" :status="$cr->status" :completed=null />
                    @endforeach 
                </div>
            </div>
            @endif
        </div>
        <x-footer/>
    </div>
</x-app-layout>
<style>
    .field-details {
        position: absolute;
        top: 60%;
        height: 40%;
        width: 100%;
        transform: translateY(100%);
        transition: transform .25s linear;
    }
    .course-duration-band {
        position: absolute;
        visibility: hidden;
        top: 100px;
        height: 28px;
        width: 100%;
        transform: translateY(100%);
        transition: transform .25s linear;
    }
    p.text-sm.text-gray-700.leading-5 {
        display: none;
    }
</style>