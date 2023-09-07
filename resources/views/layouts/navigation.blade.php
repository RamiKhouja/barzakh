<nav x-data="{ open: false }" class="bg-primary-100 dark:bg-gray-800 border-0 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between h-12 items-center">
            <div class="flex items-center p-6">
                <p class="font-black text-sm">AR/EN</p>
                <div class="relative rounded-full ml-4">
                    <div class="pointer-events-none absolute top-1.5 left-3 flex items-center">
                        <x-zondicon-search class="h-4 w-4 text-gray-400" aria-hidden="true" />
                    </div>
                    <input
                        type="text"
                        name="search"
                        id="search"
                        class="block w-full rounded-full border-0 py-0.5 pl-8 text-gray-700 bg-white ring-1 ring-primary-200 placeholder:text-gray-400 focus:ring-primary-500 sm:text-sm sm:leading-6"
                        placeholder="Search"
                    />
                </div>
            </div>
            <div>
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10 md:flex md:relative">
                    @auth
                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-lg text-gray-500 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-primary-200 focus:outline-none transition ease-in-out duration-150">
                                        <div class="flex items-center">
                                            @if(Auth::user()->image) 
                                                <img src="{{asset(Auth::user()->image)}}" alt="{{ Auth::user()->firstname }}" class="w-7 h-7 rounded-full object-cover mr-2"/>
                                            @endif
                                            {{ Auth::user()->firstname }}
                                        </div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-primary-700 hover:bg-primary-200 px-2 py-0.5 rounded-lg dark:text-gray-50 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-primary-700 hover:bg-primary-200 px-2 py-0.5 rounded-lg dark:text-gray-50 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
                
            </div>
        </div>
        @if (Request::path() == '/')
        <div class="flex justify-center">
            <img src="{{ asset('pictures/global/logo-main.png') }}" class="h-32" alt=""/>
        </div>
        @endif
        <div class="flex justify-center">
            <div class="flex-wrap my-4 space-x-2 text-primary-700 font-semibold">
                <a href="/" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Home') }}</a>
                <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('About us') }}</a>
                <a href="/#courses" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Courses') }}</a>
                <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Instructors') }}</a>
                <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Plans') }}</a>
                <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Partners') }}</a>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        
    </div>
</nav>