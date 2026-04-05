<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @props(['meta_title', 'meta_description', 'meta_image', 'meta_url'])
        <meta property="og:url" content="{{ $meta_url ?? url()->current() }}">
        <meta property="og:title" content="{{ $meta_title ?? __('nav.Admin') }}">
        <meta property="og:description" content="{{ $meta_description ?? 'Barzakh administration panel' }}">
        <meta property="og:image" content="{{ $meta_image ?? asset('pictures/global/og-main.jpeg') }}">

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <title>{{ __('nav.Admin') }}</title>

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            html:not(.theme-ready) body {
                visibility: hidden;
            }
        </style>
        <script>
            (function () {
                const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                document.documentElement.classList.remove('light', 'dark');
                document.documentElement.classList.add(savedTheme, 'theme-ready');
            })();
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased light" x-data="{ darkMode: true }" style="font-family:{{ app()->getLocale() == 'ar' ? 'Amiri' : 'PT Serif' }}">
        <div class="min-h-screen bg-primary-50 dark:bg-gray-700">
            @include('layouts.admin-navigation')

            <div class="min-h-screen transition-all duration-300 {{ app()->getLocale() === 'ar' ? 'lg:pr-72' : 'lg:pl-72' }}">
                <header class="fixed top-0 z-40 hidden border-b border-primary-200 bg-white/90 backdrop-blur dark:border-gray-400 dark:bg-gray-700 lg:block {{ app()->getLocale() === 'ar' ? 'right-72 left-0' : 'left-72 right-0' }}">
                    <div class="flex items-center justify-between gap-4 px-6 py-4 xl:px-10" x-data="{ userMenuOpen: false }">
                        <div class="w-full max-w-xl">
                            <form action="{{ route('admin.courses.search') }}" method="GET" class="relative">
                                <div class="pointer-events-none absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center">
                                    <x-zondicon-search class="h-4 w-4 text-primary-700 dark:text-white" />
                                </div>
                                <input
                                    type="text"
                                    name="q"
                                    value="{{ request('q') }}"
                                    class="block w-full rounded-full border-0 bg-primary-100 py-3 text-sm text-gray-700 ring-1 ring-primary-200 placeholder:text-primary-500 focus:ring-primary-500 dark:bg-gray-400 dark:text-white dark:ring-gray-400 dark:placeholder:text-gray-100 {{ app()->getLocale() === 'ar' ? 'pr-11 pl-4 text-right' : 'pl-11 pr-4 text-left' }}"
                                    placeholder="{{ __('admin.search_placeholder') }}"
                                />
                            </form>
                        </div>

                        <div class="flex items-center gap-4">
                        <form action="{{ route('setLocale') }}" method="POST">
                            @csrf
                            <select name="locale" onchange="this.form.submit()" class="rounded-xl border-0 bg-primary-100 text-sm text-primary-700 focus:ring-primary-300 dark:bg-gray-400 dark:text-white">
                                <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                        </form>

                        <button id="theme-toggle-button-desktop" type="button" class="rounded-full bg-primary-100 p-2 text-primary-700 dark:bg-gray-400 dark:text-white">
                            <x-heroicon-s-moon class="h-5 w-5 dark:hidden" />
                            <x-heroicon-s-sun class="hidden h-5 w-5 dark:block" />
                        </button>

                        <div class="relative">
                            <button @click="userMenuOpen = !userMenuOpen" type="button" class="flex items-center gap-3 rounded-2xl border border-primary-200 bg-primary-50 px-4 py-2 text-left shadow-sm transition hover:bg-primary-100 dark:border-gray-400 dark:bg-stone dark:hover:bg-gray-400">
                                <div class="shrink-0">
                                    @if(Auth::user()?->image)
                                        <img
                                            src="{{ asset(Auth::user()->image) }}"
                                            alt="{{ Auth::user()->firstname }}"
                                            class="h-10 w-10 rounded-full object-cover"
                                        />
                                    @else
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-200 text-sm font-semibold text-primary-700 dark:bg-gray-400 dark:text-white">
                                            {{ strtoupper(substr(Auth::user()?->firstname ?? 'A', 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-primary-800 dark:text-white">{{ Auth::user()->firstname ?? 'Admin' }}</p>
                                    <p class="truncate text-xs text-primary-500 dark:text-gray-100">{{ Auth::user()->email }}</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-600 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <div x-show="userMenuOpen" x-transition @click.outside="userMenuOpen = false" class="absolute right-0 z-40 mt-3 w-56 rounded-2xl border border-primary-200 bg-white p-2 shadow-xl dark:border-gray-400 dark:bg-gray-400">
                                <a href="{{ route('admin.profile.edit') }}" class="mb-1 block rounded-xl px-4 py-3 text-sm font-medium text-primary-700 transition hover:bg-primary-100 dark:text-white dark:hover:bg-stone">
                                    {{ __('nav.Profile') }}
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full rounded-xl px-4 py-3 text-left text-sm font-medium text-red-600 transition hover:bg-red-50 dark:text-white dark:hover:bg-stone">
                                        {{ __('nav.Log-Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </header>

                <main class="min-h-screen lg:pt-24">
                    <div class="px-4 py-8 sm:px-6 lg:px-10">
                    {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    </body>
</html>
