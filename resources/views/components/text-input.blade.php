@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 dark:focus:border-gray-100 focus:ring-primary-500 dark:focus:ring-gray-100 rounded-md shadow-sm']) !!}>
