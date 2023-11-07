<?php 
    $lang = app()->getLocale(); 
?>
@if($lang=='ar')
<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-right text-sm leading-5 text-gray-700 dark:text-gray-50 hover:bg-primary-200 dark:bg-gray-400 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out']) }}>{{ $slot }}</a>
@else
<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-50 hover:bg-primary-200 dark:bg-gray-400 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out']) }}>{{ $slot }}</a>
@endif