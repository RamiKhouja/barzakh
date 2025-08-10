<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <?php $lang = app()->getLocale(); ?>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}">
            <x-input-label for="email" :value="__('auth.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}">
            <x-input-label for="password" :value="__('auth.password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="{{$lang=='ar'?('mr-2'):('ml-2')}} text-sm text-gray-600 dark:text-gray-50">{{ __('auth.remember') }}</span>
            </label>
        </div>

        <div class="flex items-center mt-4 justify-end" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}">
            @if (Route::has('password.request'))
                <a class="underline {{$lang=='ar'?('ml-3'):('mr-3')}} text-sm text-gray-700 dark:text-white hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                    {{ __('auth.noaccount') }}
                </a>
            @endif
            <button type="submit" class="primary-btn">{{ __('auth.login') }}</button>
        </div>
        <div class=" mt-4">
            <a href="{{ route('password.request') }}" class="text-sm text-gray-700 underline">{{ __('auth.forgot') }}</a>
        </div>
    </form>
    <a href="{{ route('google.redirect') }}" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}"
        class="mt-4 flex items-center justify-center gap-3 px-6 py-2 rounded-md shadow text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition"
    >
        <!-- Google logo SVG -->
        <svg class="w-5 h-5" viewBox="0 0 48 48">
            <path fill="#EA4335" d="M24 9.5c3.5 0 6.6 1.2 9 3.3l6.7-6.6C35.5 2.3 30.1 0 24 0 14.7 0 6.8 5.4 2.8 13.3l7.8 6.1C12.7 13.2 17.9 9.5 24 9.5z"/>
            <path fill="#4285F4" d="M46.5 24c0-1.6-.1-3.1-.4-4.5H24v9h12.7c-1 2.8-2.7 5-4.9 6.6l7.6 5.9c4.5-4.2 7.1-10.3 7.1-17z"/>
            <path fill="#FBBC05" d="M10.6 28.1C9.7 25.7 9.2 23 9.2 20.1c0-2.9.5-5.6 1.4-8.1l-7.8-6.1C.8 11.6 0 17.6 0 24s.8 12.4 2.8 18.1l7.8-6.1z"/>
            <path fill="#34A853" d="M24 48c6.1 0 11.3-2 15.1-5.5l-7.6-5.9c-2.1 1.4-4.9 2.3-7.5 2.3-6.1 0-11.3-4.1-13.1-9.7l-7.8 6.1C6.8 42.6 14.7 48 24 48z"/>
            <path fill="none" d="M0 0h48v48H0z"/>
        </svg>

        <span>{{ __('auth.google-signin') }}</span>
    </a>
</x-guest-layout>
