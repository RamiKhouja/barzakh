<x-guest-layout>
<?php $lang = app()->getLocale(); ?>
    <form method="POST" action="{{ route('register') }}" dir="{{$lang=='ar' ? ('rtl') : ('ltr')}}">
        @csrf

        <div class="mt-4">
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="sex" value="male" {{ old('sex') == 'male' ? 'checked' : '' }}>
                    <span class="{{$lang=='ar'?('mr-2'):('ml-2')}}">{{__('auth.mr')}}</span>
                </label>
                <label class="inline-flex items-center ml-6">
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
</x-guest-layout>
