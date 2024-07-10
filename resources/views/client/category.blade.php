<x-app-layout>
    <?php $lang = app()->getLocale(); ?>
    <div class="bg-primary-100 dark:bg-gray-700">
        <div class="h-20"></div>
        <div class="max-w-xs sm:max-w-sm md:max-w-xl lg:max-w-4xl xl:max-w-5xl mx-auto mt-8 md:-mt-20 mb-36">
            <div class="flex {{$lang == 'ar' ? ('flex-row-reverse') : ('')}}  md:mt-20 mb-20">
                <p class="text-sm md:text-base lg:text-lg">
                    <a href="{{ route('fields.showUrl', ['url' => $category->field->url]) }}" 
                        class="text-gray-400 hover:text-gray-700 dark:text-gray-50 dark:hover:text-white"
                    >
                        {{$category->field->title}}
                    </a>
                </p>
                @if($lang == 'ar') 
                <x-heroicon-s-chevron-left class="w-4 mx-2 dark:text-white"/>
                @else
                <x-heroicon-s-chevron-right class="w-4 mx-2 dark:text-white" />
                @endif
                    
                <p class="text-sm md:text-base lg:text-lg text-gray-700 dark:text-white font-semibold">
                    {{$lang == 'ar' ? $category->title_ar : $category->title_en}}
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 container" dir="{{$lang == 'ar' ? ('rtl') : ('ltr')}}">
                @foreach($courses as $course)
                    <x-course :course="$course" :status=null :completed=null />
                @endforeach
            </div>
            <div class="pagination mt-20">
                {{ $courses->links() }}
            </div>
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