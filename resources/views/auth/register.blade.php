<x-guest-layout>
<?php $lang = app()->getLocale(); ?>
    <form method="POST" action="{{ route('register') }}" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}">
        @csrf

        <div class="mt-4">
            <div class="mt-2">
                <label class="inline-flex items-center dark:text-gray-50">
                    <input type="radio" class="form-radio" name="sex" value="male" {{ old('sex') == 'male' ? 'checked' : '' }}>
                    <span class="{{$lang=='ar'?('mr-2'):('ml-2')}}">{{__('auth.mr')}}</span>
                </label>
                <label class="inline-flex items-center ml-6 dark:text-gray-50">
                    <input type="radio" class="form-radio" name="sex" value="female" {{ old('sex') == 'female' ? 'checked' : '' }}>
                    <span class="{{$lang=='ar'?('mr-2'):('ml-2')}}">{{__('auth.ms')}}</span>
                </label>
            </div>
        </div>
        
        <div class="mt-4 flex">
            <!-- Firstname -->
            <div>
                <x-input-label for="firstname" :value="__('auth.firstname')" />
                <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
                <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
            </div>
            <!-- Lastname -->
            <div class="{{$lang=='ar'?('mr-4'):('ml-4')}}">
                <x-input-label for="lastname" :value="__('auth.lastname')" />
                <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('auth.email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('auth.password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('auth.confirmpass')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4 justify-end">
            <a class="underline {{$lang=='ar'?('ml-3'):('mr-3')}} text-sm text-gray-700 dark:text-gray-50 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('auth.haveaccount') }}
            </a>

            <button type="submit" class="primary-btn">{{ __('auth.register') }}</button>
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

        <span>{{ __('auth.google-signup') }}</span>
    </a>
</x-guest-layout>
