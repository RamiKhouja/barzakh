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
</x-guest-layout>
