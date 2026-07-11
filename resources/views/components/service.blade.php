<?php $lang = app()->getLocale(); ?>
<div class="rounded-3xl my-4 group shadow-md relative">
    <div>
        <img src="{{ asset( 'pictures/'.$service->image ) }}"  class="object-cover h-40 w-full rounded-t-3xl">
        <div class="group-hover:bg-primary-200 relative rounded-b-3xl p-4 bg-primary-150 dark:bg-gray-400 dark:group-hover:bg-gray-500">   
            <p class="mt-2 text-xl md:text-base lg:text-2xl text-stoned-900 dark:text-primary-100 font-semibold mb-4 {{$lang == 'ar' ? ('text-right') : ('')}}" title="{{$lang == 'ar' ? ($service->title_ar) : ($service->title_en)}}">
                {{ $lang == 'ar' ? $service->title_ar : $service->title_en }}
            </p>
            <div class="wysiwyg-content text-base text-stone dark:text-primary-200 mt-4" dir="{{ $lang == 'ar' ? 'rtl' : 'ltr' }}">
                {!! $lang == 'ar' ? ($service->description_ar ?? '') : ($service->description_en ?? '') !!}
            </div>
            <div class="mt-4 flex flex-row-reverse gap-3">
                <button
                    type="button"
                    onclick="openServiceRequestModal('{{ $service->id }}', @js($lang == 'ar' ? $service->title_ar : $service->title_en))"
                    class="rounded-full px-4 py-1 bg-bordo border border-bordo text-white hover:bg-primary-200 hover:dark:bg-gray-500 hover:text-bordo hover:dark:text-white hover:dark:border-white"
                >
                    {{__('services.button')}}
                </button>
                <a href="{{ route('service.showUrl', ['url' => $service->url]) }}" class="rounded-full px-4 py-1 border border-bordo text-bordo dark:text-white hover:bg-primary-200 hover:dark:bg-gray-500 hover:dark:border-white">
                    {{ __('admin.view_page') }}
                </a>
            </div>
        </div>
    </div>
</div>
