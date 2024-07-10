<nav x-data="{ open: false }" class="bg-primary-100 dark:bg-gray-700 border-0 dark:border-gray-700 fixed top-0 z-50 w-full md:relative md:shadow-none" id="navigation">
    <!-- Primary Navigation Menu -->
    <?php 
        $lang = app()->getLocale(); 
    ?>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-0 w-full bg-primary-100 dark:bg-gray-700 group dark:shadow-none" id="navbar">
        <div class="flex justify-between {{ Request::path() == '/' ? 'items-start' : 'items-center'}} nav-content">
            <div>
                <button @click="open = !open" class="md:hidden block text-gray-600 hover:text-gray-900 dark:text-gray-50 dark:hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <div id="leftNav" class="md:w-1/5 lg:w-1/4">
                <div class="items-center p-6 hidden md:flex md:flex-wrap lg:flex-nowrap md:space-y-2 lg:space-y-0 justify-center">
                    <button id="theme-toggle-button" class="mr-4 bg-primary-200 rounded-full p-1 dark:bg-gray-400">
                        <x-heroicon-s-moon class="w-6 h-6 text-gray-700 dark:hidden" />
                        <x-heroicon-s-sun class="w-6 h-6 text-white hidden dark:block" />
                    </button>
                    <div class="language-switcher">
                        <form action="{{ route('setLocale') }}" method="POST">
                            @csrf
                            <select name="locale" onchange="this.form.submit()" class="border-0 bg-primary-200 rounded-full text-primary-700 focus:ring-primary-300 cursor-pointer dark:bg-gray-400 dark:text-white focus:outline-0 text-sm h-8 py-1" >
                                <option value="ar" {{ $lang == 'ar' ? 'selected' : '' }} style="font-family:'Amiri';">العربية</option>
                                <option value="en" {{ $lang == 'en' ? 'selected' : '' }} style="font-family:'PT Serif';">English</option>
                            </select>
                        </form>
                    </div>
                    <div class="relative rounded-full md:ml-0 lg:ml-4">
                        <div class="pointer-events-none absolute top-2 {{ $lang=='ar' ? 'right-3' : 'left-3'}} flex items-center">
                            <x-zondicon-search class="h-4 w-4 text-primary-700" aria-hidden="true" />
                        </div>
                        <input
                            type="text"
                            name="search"
                            id="search"
                            class="block w-full rounded-full border-0 py-0.5 h-8 text-gray-700 bg-white dark:bg-gray-200 ring-1 ring-primary-200 placeholder:text-primary-700 focus:ring-primary-500 sm:text-sm sm:leading-6 {{$lang=='ar' ? 'text-right pr-8':'pl-8'}}"
                            placeholder="{{__('nav.Search')}}"
                        />
                    </div>
                </div>
            </div>
            <div class="mx-auto">
                <img src="{{ asset('pictures/global/logo.png') }}" class="h-10 md:hidden dark:hidden" alt=""/>
                <img src="{{ asset('pictures/global/logo-white.png') }}" class="hidden dark:block h-10 md:hidden dark:md:hidden" alt=""/>
            </div>
            <div class="nav-center md:w-3/5 lg:w-1/2 hidden md:block">
                @if (Request::path() == '/')
                <div class="flex justify-center mt-12 logo">
                
                <img src="{{ asset( 'pictures/global/logo-main.png') }}" class="h-32" alt=""/>
                </div>
                @endif
                <div class="flex justify-center items-center my-3">
                @auth
                    @if(Auth::user()->role == 'admin') 
                    <div class="flex-wrap my-4 space-x-2 text-primary-700 dark:text-gray-50 font-medium text-lg">
                        <a href="{{ route('admin.fields') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Axes') }}</a>
                        <a href="{{ route('admin.categories') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Categories') }}</a>
                        <a href="{{ route('admin.packs') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Packs') }}</a>
                        <a href="{{ route('admin.courses') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Courses') }}</a>
                        <a href="{{ route('admin.instructors') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Instructors') }}</a>
                        <a href="{{ route('admin.offers') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('Offers') }}</a>
                        <a href="{{ route('admin.requests') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('Requests') }}</a>
                    </div>
                    @else
                    <div class="flex-wrap my-4 space-x-2 text-primary-700 dark:text-gray-50 font-medium text-lg">
                        <a href="{{route('home')}}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg {{ request()->is('/') ? 'font-bold dark:text-white' : '' }}">{{ __('nav.Home') }}</a>
                        <a href="{{route('about')}}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.About-us') }}</a>
                        @if (Request::path() == '/')
                        <a href="{{ url(route('home') . '#courses') }}" onclick="smallNav()" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Courses') }}</a>
                        @else
                        <div class="dropdown">
                            <button class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-t-lg flex space-x-2 items-center {{ (request()->is('course/*') || request()->is('categories/*')) ? 'font-bold dark:text-white' : '' }}">{{ __('nav.Courses') }}</button>
                            <div class="dropdown-content bg-primary-50 dark:bg-gray-400 dark:text-gray-50 {{$lang=='ar' ? ('text-right right-0'):('')}}">
                                <a href="{{ route('fields.showUrl', ['url' => 'religious-vision']) }}" class="hover:bg-primary-200 dark:hover:bg-gray-400">
                                    {{__('nav.religious-vision')}}
                                </a>
                                <a href="{{ route('fields.showUrl', ['url' => 'beauty-vision']) }}" class="hover:bg-primary-200 dark:hover:bg-gray-400">
                                    {{__('nav.beauty-vision')}}
                                </a>
                                <a href="{{ route('fields.showUrl', ['url' => 'scientific-and-philosophical-vision']) }}" class="hover:bg-primary-200 dark:hover:bg-gray-400">
                                    {{__('nav.scientific-and-philosophical-vision')}}
                                </a>
                            </div>
                        </div>
                        @endif
                        
                        <a href="{{ url(route('home') . '#instructors') }}" onclick="smallNav()" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Instructors') }}</a>
                        <a href="{{ url(route('home') . '#plans') }}" onclick="smallNav()" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Plans') }}</a>
                        <a href="{{ url(route('home') . '#partners') }}" onclick="smallNav()" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Partners') }}</a>
                    </div>
                    @endif
                @else
                    <div class="flex-wrap space-x-2 text-primary-700 dark:text-gray-50 font-medium text-lg">
                        <a href="{{route('home')}}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg {{ request()->is('/') ? 'font-bold dark:text-white' : '' }}">{{ __('nav.Home') }}</a>
                        <a href="{{route('about')}}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.About-us') }}</a>
                        
                        @if (Request::path() == '/')
                        <a href="{{ url(route('home') . '#courses') }}" onclick="smallNav()" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Courses') }}</a>
                        @else
                        <div class="dropdown">
                            <button class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-t-lg {{ (request()->is('course/*') || request()->is('categories/*') ) ? 'font-bold dark:text-white' : '' }}">{{ __('nav.Courses') }}</button>
                            <div class="dropdown-content rounded-b-lg bg-primary-50 dark:bg-gray-400 dark:text-gray-50 {{$lang=='ar' ? ('text-right right-0 rounded-tl-lg'):('rounded-tr-lg')}}">
                                <a href="{{ route('fields.showUrl', ['url' => 'religious-vision']) }}" class="hover:bg-primary-200 dark:hover:bg-gray-300">
                                    {{__('nav.religious-vision')}}
                                </a>
                                <a href="{{ route('fields.showUrl', ['url' => 'beauty-vision']) }}" class="hover:bg-primary-200 dark:hover:bg-gray-300">
                                    {{__('nav.beauty-vision')}}
                                </a>
                                <a href="{{ route('fields.showUrl', ['url' => 'scientific-and-philosophical-vision']) }}" class="hover:bg-primary-200 dark:hover:bg-gray-300">
                                    {{__('nav.scientific-and-philosophical-vision')}}
                                </a>
                            </div>
                        </div>
                        @endif
                        <a href="{{ url(route('home') . '#instructors') }}" onclick="smallNav()" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Instructors') }}</a>
                        <a href="{{ url(route('home') . '#plans') }}" onclick="smallNav()" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Plans') }}</a>
                        <a href="{{ url(route('home') . '#partners') }}" onclick="smallNav()" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 rounded-lg">{{ __('nav.Partners') }}</a>
                    </div>
                @endauth
                </div>
            </div>
            <div id="rightNav" class="md:w-1/5 lg:w-1/4">
            @if (Route::has('login'))
                <div class="md:p-6 text-right z-10 md:flex-wrap md:relative justify-end">
                    @auth
                        <!-- Settings Dropdown -->
                        <div class="sm:flex sm:items-center sm:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center sm:px-3 sm:py-2 text-sm leading-4 font-medium rounded-lg text-gray-500 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-primary-200 dark:hover:bg-gray-400 focus:outline-none transition ease-in-out duration-150">
                                        <div class="flex items-center">
                                            @if(Auth::user()->image) 
                                                <img src="{{ asset( 'pictures/'.Auth::user()->image )}}" alt="{{ Auth::user()->firstname }}" class="w-7 h-7 rounded-full object-cover md:mr-2"/>
                                            @endif
                                            <p class="hidden sm:block dark:text-white">{{ Auth::user()->firstname }}</p>
                                        </div>

                                        <div class="hidden sm:block sm:ml-1">
                                            <x-heroicon-m-chevron-down class="w-5 h-5 text-gray-700 dark:text-white" />
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('nav.Profile') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('profile.courses')">
                                        {{ __('nav.my-courses') }}
                                    </x-dropdown-link>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('nav.Log-Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <div class="sm:flex sm:items-center sm:ml-6 md:hidden">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="sm:px-3 sm:py-2 transition ease-in-out duration-150">
                                        <x-heroicon-s-user-circle class="h-7 w-7 text-gray-500 dark:text-white" />
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('login')">
                                        {{ __('nav.Login') }}
                                    </x-dropdown-link>
                                    @if (Route::has('register'))
                                    <x-dropdown-link :href="route('register')">
                                        {{ __('nav.Register') }}
                                    </x-dropdown-link>
                                    @endif
                                    
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <div class="flex items-center" dir="{{$lang=='ar'?('rtl'):('')}}">
                            <a href="{{ route('login') }}" class="hidden md:inline-block text-lg font-medium text-primary-700 hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 dark:text-gray-50 dark:hover:text-white rounded-lg">{{__('nav.Login')}}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hidden md:inline-block text-lg ml-4 font-medium text-primary-700 hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-1 dark:text-gray-50 dark:hover:text-white rounded-lg">{{__('nav.Register')}}</a>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
                
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    

    <div x-show="open" class="md:hidden fixed top-0 left-0 h-full w-3/4 bg-primary-200 dark:bg-gray-400 shadow-lg z-20">
        <!-- Menu content goes here -->
        <div class="p-4 space-y-4 h-screen">
            <div class="flex justify-end">
                <button @click="open = !open" class="md:hidden block text-gray-600 hover:text-gray-900 dark:text-gray-50 dark:hover:text-white">
                    <x-zondicon-close class="w-4 h-4" />
                </button>
            </div>
            <div class="flex flex-col h-full justify-between">
                <div class="text-center mt-4">
                    <button id="theme-toggle-button-resp" class="mb-4">
                        <x-heroicon-s-moon class="w-6 h-6 text-gray-700 dark:hidden" />
                        <x-heroicon-s-sun class="w-6 h-6 text-white hidden dark:block" />
                    </button>
                    <div class="language-switcher mb-4">
                        <form action="{{ route('setLocale') }}" method="POST">
                            @csrf
                            <select name="locale" onchange="this.form.submit()" class="border-0 py-1 h-8 bg-primary-200 text-primary-700 focus:ring-primary-300 dark:bg-gray-400 dark:text-white focus:outline-0" >
                                <option value="ar" {{ $lang == 'ar' ? 'selected' : '' }}>العربية</option>
                                <option value="en" {{ $lang == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                        </form>
                    </div>
                    <div class="relative rounded-full">
                        <div class="pointer-events-none absolute top-2 {{ $lang=='ar' ? 'right-3' : 'left-3'}} flex items-center">
                            <x-zondicon-search class="h-4 w-4 text-primary-700" aria-hidden="true" />
                        </div>
                        <input
                            type="text"
                            name="search"
                            id="search"
                            class="block w-full rounded-full border-0 py-0.5 h-8 text-gray-700 bg-white dark:bg-gray-200 ring-1 ring-primary-200 placeholder:text-primary-700 focus:ring-primary-500 sm:text-sm sm:leading-6 {{$lang=='ar' ? 'text-right pr-8':'pl-8'}}"
                            placeholder="{{__('nav.Search')}}"
                        />
                    </div>
                </div>
                
                <!-- Add your menu items here -->
                <div class="mt-8 space-y-2 flex-col text-center">
                    <!-- Menu items -->
                    @auth
                        @if(Auth::user()->role == 'admin') 
                            <div><a href="{{ route('admin.dashboard') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Dashboard') }}</a></div>
                            <div><a href="{{ route('admin.fields') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Axes') }}</a></div>
                            <div><a href="{{ route('admin.categories') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Categories') }}</a></div>
                            <div><a href="{{ route('admin.packs') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Packs') }}</a></div>
                            <div><a href="{{ route('admin.courses') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Courses') }}</a></div>
                            <div><a href="{{ route('admin.instructors') }}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Instructors') }}</a></div>
                        
                        @else
                            <div><a href="{{route('home')}}" @click="open = !open" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Home') }}</a></div>
                            <div><a href="{{route('about')}}" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.About-us') }}</a></div>
                            <div><a href="{{ url(route('home') . '#courses') }}" @click="open = !open" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Courses') }}</a></div>
                            <div><a href="{{ url(route('home') . '#instructors') }}" @click="open = !open" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Instructors') }}</a></div>
                            <div><a href="" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Plans') }}</a></div>
                            <div><a href="" class="hover:bg-primary-200 dark:hover:bg-gray-400 px-2 py-0.5 rounded-lg">{{ __('nav.Partners') }}</a></div>
                        
                        @endif
                    @else
                            <div><a href="{{route('home')}}" @click="open = !open" class="resp-menu-item">{{ __('nav.Home') }}</a></div>
                            <div><a href="{{route('about')}}" class="resp-menu-item">{{ __('nav.About-us') }}</a></div>
                            <div><a href="{{ url(route('home') . '#courses') }}" @click="open = !open" class="resp-menu-item">{{ __('nav.Courses') }}</a></div>
                            <div><a href="{{ url(route('home') . '#instructors') }}" @click="open = !open" class="resp-menu-item">{{ __('nav.Instructors') }}</a></div>
                            <div><a href="" class="resp-menu-item">{{ __('nav.Plans') }}</a></div>
                            <div><a href="" class="resp-menu-item">{{ __('nav.Partners') }}</a></div>
                        
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
<style>
.dropdown {
  position: relative;
  display: inline-block;
}
.dropdown-content {
  display: none;
  position: absolute;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown:hover .dropdown-content {
  display: block;
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
    const leftNav = document.getElementById('leftNav');
    const rightNav = document.getElementById('rightNav');

    function smallNav(){
        navbar.classList.add('fixed');
            navbar.classList.add('dark:border-b');
            navbar.classList.add('dark:border-b-gray-100');
            leftNav.classList.remove('lg:w-1/4');
            rightNav.classList.remove('lg:w-1/4');
            leftNav.classList.add('lg:w-1/3');
            rightNav.classList.add('lg:w-1/5');
    }

    window.addEventListener('scroll', () => {
        if (window.scrollY > threshold) {
            navbar.classList.add('fixed');
            navbar.classList.add('dark:border-b');
            navbar.classList.add('dark:border-b-gray-100');
            leftNav.classList.remove('lg:w-1/4');
            rightNav.classList.remove('lg:w-1/4');
            leftNav.classList.add('lg:w-1/3');
            rightNav.classList.add('lg:w-1/5');
        } else {
            navbar.classList.remove('fixed');
            navbar.classList.remove('dark:border-b');
            navbar.classList.remove('dark:border-b-gray-100');
            leftNav.classList.remove('lg:w-1/3');
            rightNav.classList.remove('lg:w-1/5');
            leftNav.classList.add('lg:w-1/4');
            rightNav.classList.add('lg:w-1/4');
        }
    });

    // Get the theme preference from localStorage or default to 'light'
    // const savedTheme = localStorage.getItem('theme') || 'light';
    // document.documentElement.classList.add(savedTheme);

    // Function to toggle the theme
    function toggleTheme() {
        console.log('old theme : ', localStorage.getItem('theme'));
        const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        document.documentElement.classList.remove(currentTheme);
        document.documentElement.classList.add(newTheme);

        // Save the theme preference to localStorage
        localStorage.setItem('theme', newTheme);
        console.log('new theme : ', localStorage.getItem('theme'));
    }

    // Add click event listener to the theme toggle button
    document.getElementById('theme-toggle-button').addEventListener('click', toggleTheme);
    document.getElementById('theme-toggle-button-resp').addEventListener('click', toggleTheme);

</script>