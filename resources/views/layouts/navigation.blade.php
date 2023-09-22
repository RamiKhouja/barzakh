<nav x-data="{ open: false }" class="bg-primary-100 dark:bg-gray-800 border-0 dark:border-gray-700 fixed top-0 z-50 w-full md:relative md:shadow-none" id="navigation">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-0 w-full bg-primary-100 group" id="navbar">
        <div class="flex justify-between {{ Request::path() == '/' ? 'items-start' : 'items-center'}} nav-content">
            <div>
                <button @click="open = !open" class="md:hidden block text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <div class="md:w-1/5 lg:w-1/4">
                <div class="items-center p-6 hidden md:flex md:flex-wrap lg:flex-nowrap md:space-y-2 lg:space-y-0 justify-center">
                    <p class="font-black text-sm">AR/EN</p>
                    <div class="relative rounded-full md:ml-0 lg:ml-4">
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
            </div>
            <div class="nav-center md:w-3/5 lg:w-1/2 hidden md:block">
                @if (Request::path() == '/')
                <div class="flex justify-center mt-12 logo">
                    <img src="{{ asset('pictures/global/logo-main.png') }}" class="h-32" alt=""/>
                </div>
                @endif
                <div class="flex justify-center">
                @auth
                    @if(Auth::user()->role == 'admin') 
                    <div class="flex-wrap my-4 space-x-2 text-primary-700 font-semibold">
                        <a href="{{ route('admin.dashboard') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Dashboard') }}</a>
                        <a href="{{ route('admin.fields') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Axes') }}</a>
                        <a href="{{ route('admin.categories') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Categories') }}</a>
                        <a href="{{ route('admin.courses') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Courses') }}</a>
                        <a href="{{ route('admin.instructors') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Instructors') }}</a>
                    </div>
                    @else
                    <div class="flex-wrap my-4 space-x-2 text-primary-700 font-semibold">
                        <a href="/" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Home') }}</a>
                        <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('About us') }}</a>
                        <a href="/#courses" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Courses') }}</a>
                        <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Instructors') }}</a>
                        <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Plans') }}</a>
                        <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Partners') }}</a>
                    </div>
                    @endif
                @else
                    <div class="flex-wrap my-4 space-x-2 text-primary-700 font-semibold">
                        <a href="/" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Home') }}</a>
                        <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('About us') }}</a>
                        <a href="/#courses" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Courses') }}</a>
                        <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Instructors') }}</a>
                        <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Plans') }}</a>
                        <a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Partners') }}</a>
                    </div>
                @endauth
                </div>
            </div>
            <div class="md:w-1/5 lg:w-1/4">
            @if (Route::has('login'))
                <div class="md:p-6 text-right z-10 md:flex-wrap md:relative justify-end">
                    @auth
                        <!-- Settings Dropdown -->
                        <div class="sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center sm:px-3 sm:py-2 text-sm leading-4 font-medium rounded-lg text-gray-500 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-primary-200 focus:outline-none transition ease-in-out duration-150">
                                        <div class="flex items-center">
                                            @if(Auth::user()->image) 
                                                <img src="{{asset(Auth::user()->image)}}" alt="{{ Auth::user()->firstname }}" class="w-7 h-7 rounded-full object-cover md:mr-2"/>
                                            @endif
                                            <p class="hidden sm:block">{{ Auth::user()->firstname }}</p>
                                        </div>

                                        <div class="hidden sm:block sm:ml-1">
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
    </div>

    <!-- Responsive Navigation Menu -->
    

    <div x-show="open" class="md:hidden fixed top-0 left-0 h-full w-3/4 bg-primary-200 dark:bg-gray-900 shadow-lg z-20">
        <!-- Menu content goes here -->
        <div class="p-4 space-y-4 h-screen">
            <div class="flex justify-end">
                <button @click="open = !open" class="md:hidden block text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    <x-zondicon-close class="w-4 h-4" />
                </button>
            </div>
            <div class="flex flex-col h-full justify-between">
                <div class="text-center mt-4">
                    <p class="font-black text-sm mb-4">AR/EN</p>
                    <div class="relative rounded-full">
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
                
                <!-- Add your menu items here -->
                <div class="mt-8 space-y-2 flex-col text-center">
                    <!-- Menu items -->
                    @auth
                        @if(Auth::user()->role == 'admin') 
                            <div><a href="{{ route('admin.dashboard') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Dashboard') }}</a></div>
                            <div><a href="{{ route('admin.fields') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Axes') }}</a></div>
                            <div><a href="{{ route('admin.categories') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Categories') }}</a></div>
                            <div><a href="{{ route('admin.courses') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Courses') }}</a></div>
                            <div><a href="{{ route('admin.instructors') }}" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Instructors') }}</a></div>
                        
                        @else
                            <div><a href="/" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Home') }}</a></div>
                            <div><a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('About us') }}</a></div>
                            <div><a href="/#courses" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Courses') }}</a></div>
                            <div><a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Instructors') }}</a></div>
                            <div><a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Plans') }}</a></div>
                            <div><a href="" class="hover:bg-primary-200 px-2 py-0.5 rounded-lg">{{ __('Partners') }}</a></div>
                        
                        @endif
                    @else
                            <div><a href="/" class="resp-menu-item">{{ __('Home') }}</a></div>
                            <div><a href="" class="resp-menu-item">{{ __('About us') }}</a></div>
                            <div><a href="/#courses" class="resp-menu-item">{{ __('Courses') }}</a></div>
                            <div><a href="" class="resp-menu-item">{{ __('Instructors') }}</a></div>
                            <div><a href="" class="resp-menu-item">{{ __('Plans') }}</a></div>
                            <div><a href="" class="resp-menu-item">{{ __('Partners') }}</a></div>
                        
                    @endauth
                    <!-- ... -->
                </div>
                <div class="py-20 flex justify-center">
                    <img src="{{ asset('pictures/global/logo.png') }}" class="h-12" alt=""/>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    #navbar.fixed .nav-content {
        align-items: center;
    }
    #navbar.fixed .logo {
    display: none; /* Remove the logo when fixed */
}
</style>

<script>
    window.addEventListener("scroll", function () {
        const navigation = document.getElementById("navigation");
        const scrollPosition = window.scrollY;

        // Add or remove the shadow class based on scroll position
        if (scrollPosition > 0) {
            navigation.classList.add("shadow");
        } else {
            navigation.classList.remove("shadow");
        }
    });

    const navbar = document.getElementById('navbar');
    const logo = document.querySelector('.logo');
    const threshold = 200; // Adjust this value as needed

    window.addEventListener('scroll', () => {
        if (window.scrollY > threshold) {
            navbar.classList.add('fixed');
        } else {
            navbar.classList.remove('fixed');
        }
    });

</script>