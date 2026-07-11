@php
    $lang = app()->getLocale();
    $navItems = [
        ['route' => 'admin.dashboard', 'label' => __('nav.Dashboard'), 'icon' => 'heroicon-s-home', 'patterns' => ['admin.dashboard']],
        ['route' => 'admin.reports', 'label' => __('nav.Reports'), 'icon' => 'heroicon-s-chart-bar', 'patterns' => ['admin.reports']],
        ['route' => 'admin.fields', 'label' => __('nav.Axes'), 'icon' => 'heroicon-s-squares-2x2', 'patterns' => ['admin.fields', 'field.*']],
        ['route' => 'admin.categories', 'label' => __('nav.Categories'), 'icon' => 'heroicon-s-queue-list', 'patterns' => ['admin.categories', 'admin.category.*']],
        ['route' => 'admin.courses', 'label' => __('nav.Courses'), 'icon' => 'heroicon-s-academic-cap', 'patterns' => ['admin.courses', 'admin.courses.search', 'admin.course.*']],
        ['route' => 'admin.packs', 'label' => __('nav.Packs'), 'icon' => 'heroicon-s-archive-box', 'patterns' => ['admin.packs', 'admin.pack.*']],
        ['route' => 'admin.instructors', 'label' => __('nav.Instructors'), 'icon' => 'heroicon-s-users', 'patterns' => ['admin.instructors', 'instructor.*', 'admin.instructor.*']],
        [
            'label' => __('nav.Course-Sponsorship'),
            'icon' => 'heroicon-s-megaphone',
            'state' => 'courseSponsorshipOpen',
            'children' => [
                ['route' => 'admin.offers', 'label' => __('nav.Offers'), 'icon' => 'heroicon-s-ticket', 'patterns' => ['admin.offers']],
                ['route' => 'admin.requests', 'label' => __('nav.Requests'), 'icon' => 'heroicon-s-inbox-stack', 'patterns' => ['admin.requests', 'admin.request.*']],
            ],
        ],
        [
            'label' => __('nav.Services'),
            'icon' => 'heroicon-s-wrench-screwdriver',
            'state' => 'serviceNavOpen',
            'children' => [
                ['route' => 'admin.services', 'label' => __('nav.Service-Offers'), 'icon' => 'heroicon-s-briefcase', 'patterns' => ['admin.services', 'admin.service.*']],
                ['route' => 'admin.service-requests.index', 'label' => __('nav.Service-Requests'), 'icon' => 'heroicon-s-clipboard-document-list', 'patterns' => ['admin.service-requests.*']],
            ],
        ],
        ['route' => 'admin.partners', 'label' => __('nav.Partners'), 'icon' => 'heroicon-s-building-office-2', 'patterns' => ['admin.partners', 'admin.partner.*']],
        ['route' => 'admin.about.edit', 'label' => __('nav.About-page'), 'icon' => 'heroicon-s-information-circle', 'patterns' => ['admin.about.*']],
        ['route' => 'admin.static-pages.index', 'label' => __('nav.Pages'), 'icon' => 'heroicon-s-document-text', 'patterns' => ['admin.static-pages.*']],
    ];

    $matchesPatterns = function (array $patterns): bool {
        foreach ($patterns as $pattern) {
            if (request()->routeIs($pattern)) {
                return true;
            }
        }

        return false;
    };

    $groupStates = [];

    foreach ($navItems as $item) {
        if (! isset($item['children'], $item['state'])) {
            continue;
        }

        $groupStates[$item['state']] = collect($item['children'])->contains(
            fn ($child) => $matchesPatterns($child['patterns'])
        );
    }
@endphp

<div x-data="{ open: false, mobileAccountOpen: false, serviceNavOpen: @js($groupStates['serviceNavOpen'] ?? false), courseSponsorshipOpen: @js($groupStates['courseSponsorshipOpen'] ?? false) }">
    <div class="sticky top-0 z-30 border-b border-primary-200 bg-primary-100/95 backdrop-blur dark:border-gray-400 dark:bg-gray-700 lg:hidden">
        <div class="flex items-center justify-between px-4 py-4">
            <button @click="open = true" type="button" class="rounded-lg border border-primary-300 bg-white p-2 text-primary-700 shadow-sm dark:border-gray-400 dark:bg-gray-400 dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <a href="{{ route('admin.dashboard') }}" class="text-lg font-semibold text-primary-700 dark:text-white">
                {{ __('nav.Admin') }}
            </a>

            <button id="theme-toggle-button-mobile" type="button" class="rounded-full bg-primary-200 p-2 text-primary-700 dark:bg-gray-400 dark:text-white">
                <x-heroicon-s-moon class="h-5 w-5 dark:hidden" />
                <x-heroicon-s-sun class="hidden h-5 w-5 dark:block" />
            </button>
        </div>

        <div class="px-4 pb-4">
            <form action="{{ route('admin.courses.search') }}" method="GET" class="relative">
                <div class="pointer-events-none absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 pr-4' : 'left-0 pl-4' }} flex items-center">
                    <x-zondicon-search class="h-4 w-4 text-primary-700 dark:text-white" />
                </div>
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    class="block w-full rounded-full border-0 bg-white py-3 text-sm text-gray-700 ring-1 ring-primary-200 placeholder:text-primary-500 focus:ring-primary-500 dark:bg-gray-400 dark:text-white dark:ring-gray-400 dark:placeholder:text-gray-100 {{ app()->getLocale() === 'ar' ? 'pr-11 pl-4 text-right' : 'pl-11 pr-4 text-left' }}"
                    placeholder="{{ __('admin.search_placeholder') }}"
                />
            </form>
        </div>
    </div>

    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden" @click="open = false"></div>

    <aside
        id="navigation"
        x-cloak="admin-mobile-drawer"
        class="fixed inset-y-0 w-72 {{ app()->getLocale() === 'ar' ? 'right-0 border-l' : 'left-0 border-r' }} z-50 flex flex-col border-primary-200 bg-primary-100 text-primary-800 shadow-xl transition-all duration-300 dark:border-gray-400 dark:bg-gray-700 dark:text-white"
        :class="[
            sidebarCollapsed ? 'lg:w-24' : 'lg:w-72',
            open ? 'translate-x-0 lg:translate-x-0' : '{{ app()->getLocale() === 'ar' ? 'translate-x-full lg:translate-x-0' : '-translate-x-full lg:translate-x-0' }}'
        ]"
    >
        <div class="flex items-center justify-between border-b border-primary-200 px-5 py-5 dark:border-gray-400">
            <a href="{{ route('admin.dashboard') }}" x-show="!(sidebarCollapsed && window.innerWidth >= 1024)" x-transition.opacity class="flex items-end gap-x-4 min-w-0">
                <img src="{{ asset('pictures/global/logo.png') }}" alt="Barzakh" class="h-11 dark:hidden shrink-0" />
                <img src="{{ asset('pictures/global/logo-white.png') }}" alt="Barzakh" class="hidden h-11 dark:block shrink-0" />
                <p class="mt-2 text-xs font-medium tracking-[0.18em] text-primary-500 dark:text-gray-100">
                    {{ __('nav.Admin-panel') }}
                </p>
            </a>

            <div class="flex items-center gap-2">
                <button @click="toggleSidebar()" type="button" class="hidden rounded-lg p-2 text-primary-700 transition hover:bg-primary-200 dark:text-white dark:hover:bg-gray-400 lg:block" :title="sidebarCollapsed ? '{{ __('admin.expand_sidebar') }}' : '{{ __('admin.collapse_sidebar') }}'">
                    <x-heroicon-s-bars-3-bottom-left x-show="!sidebarCollapsed" class="h-5 w-5" />
                    <x-heroicon-s-bars-3 x-show="sidebarCollapsed" class="h-5 w-5" />
                </button>

                <button @click="open = false" type="button" class="rounded-lg p-2 text-primary-700 dark:text-white lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18 18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-4 py-6">
            <div class="mb-6 rounded-2xl bg-white/70 p-4 shadow-sm dark:bg-gray-400 lg:hidden">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="shrink-0">
                            @if(Auth::user()?->image)
                                <img
                                    src="{{ asset(Auth::user()->image) }}"
                                    alt="{{ Auth::user()->firstname }}"
                                    class="h-10 w-10 rounded-full object-cover"
                                />
                            @else
                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-200 text-sm font-semibold text-primary-700 dark:bg-stone dark:text-white">
                                    {{ strtoupper(substr(Auth::user()?->firstname ?? 'A', 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-primary-800 dark:text-white">{{ Auth::user()->firstname ?? 'Admin' }}</p>
                            <p class="truncate text-xs text-primary-500 dark:text-gray-100">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <button id="theme-toggle-button" type="button" class="rounded-full bg-primary-200 p-2 text-primary-700 dark:bg-stone dark:text-white">
                        <x-heroicon-s-moon class="h-5 w-5 dark:hidden" />
                        <x-heroicon-s-sun class="hidden h-5 w-5 dark:block" />
                    </button>
                </div>

                <form action="{{ route('setLocale') }}" method="POST" class="mt-4">
                    @csrf
                    <select name="locale" onchange="this.form.submit()" class="w-full rounded-xl border-0 bg-primary-200 text-sm text-primary-700 focus:ring-primary-300 dark:bg-stone dark:text-white">
                        <option value="ar" {{ $lang == 'ar' ? 'selected' : '' }}>العربية</option>
                        <option value="en" {{ $lang == 'en' ? 'selected' : '' }}>English</option>
                    </select>
                </form>

                <div class="mt-4">
                    <button @click="mobileAccountOpen = !mobileAccountOpen" type="button" class="flex w-full items-center justify-between rounded-xl bg-primary-100 px-4 py-3 text-left text-sm font-medium text-primary-700 transition hover:bg-primary-200 dark:bg-stone dark:text-white dark:hover:bg-gray-700">
                        <span>{{ __('nav.Account') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-primary-700 transition-transform dark:text-white" :class="mobileAccountOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-cloak x-show="mobileAccountOpen" x-transition class="mt-2 space-y-2">
                        <a href="{{ route('admin.profile.edit') }}" class="block rounded-xl px-4 py-3 text-sm font-medium text-primary-700 transition hover:bg-primary-200/80 dark:text-white dark:hover:bg-stone">
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

            <nav class="space-y-2">
                @foreach ($navItems as $item)
                    @if (isset($item['children'], $item['state']))
                        @php $isActive = $groupStates[$item['state']] ?? false; @endphp
                        <div class="space-y-2">
                            <button
                                type="button"
                                @click="if (sidebarCollapsed && window.innerWidth >= 1024) { sidebarCollapsed = false; localStorage.setItem('admin-sidebar-collapsed', false); {{ $item['state'] }} = true; } else { {{ $item['state'] }} = !{{ $item['state'] }} }"
                                class="{{ $isActive ? 'bg-primary-700 text-white shadow-sm dark:bg-stone dark:text-white' : 'text-primary-700 hover:bg-primary-200/80 dark:text-gray-50 dark:hover:bg-gray-400' }} flex w-full items-center rounded-2xl px-4 py-3 text-sm font-medium transition"
                                :class="sidebarCollapsed && window.innerWidth >= 1024 ? 'justify-center' : 'justify-between'"
                                title="{{ $item['label'] }}"
                            >
                                <span class="flex items-center gap-3 min-w-0">
                                    <x-dynamic-component :component="$item['icon']" class="h-5 w-5 shrink-0" />
                                    <span x-show="!(sidebarCollapsed && window.innerWidth >= 1024)" x-transition.opacity class="truncate">{{ $item['label'] }}</span>
                                </span>
                                <svg x-show="!(sidebarCollapsed && window.innerWidth >= 1024)" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform shrink-0" :class="{{ $item['state'] }} ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <div x-show="!(sidebarCollapsed && window.innerWidth >= 1024) && {{ $item['state'] }}" x-transition class="space-y-2 px-2">
                                @foreach ($item['children'] as $child)
                                    @php $isChildActive = $matchesPatterns($child['patterns']); @endphp
                                    <a
                                        href="{{ route($child['route']) }}"
                                        class="{{ $isChildActive ? 'bg-primary-700 text-white shadow-sm dark:bg-stone dark:text-white' : 'bg-white/70 text-primary-700 hover:bg-primary-200/80 dark:bg-gray-400 dark:text-gray-50 dark:hover:bg-gray-400' }} block rounded-2xl px-4 py-3 text-sm font-medium transition"
                                    >
                                        <span class="flex items-center gap-3 min-w-0">
                                            <x-dynamic-component :component="$child['icon']" class="h-5 w-5 shrink-0" />
                                            <span class="truncate">{{ $child['label'] }}</span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        @php $isActive = $matchesPatterns($item['patterns']); @endphp
                        <a
                            href="{{ route($item['route']) }}"
                            class="{{ $isActive ? 'bg-primary-700 text-white shadow-sm dark:bg-stone dark:text-white' : 'text-primary-700 hover:bg-primary-200/80 dark:text-gray-50 dark:hover:bg-gray-400' }} flex items-center rounded-2xl px-4 py-3 text-sm font-medium transition"
                            :class="sidebarCollapsed && window.innerWidth >= 1024 ? 'justify-center' : ''"
                            title="{{ $item['label'] }}"
                        >
                            <x-dynamic-component :component="$item['icon']" class="h-5 w-5 shrink-0" />
                            <span x-show="!(sidebarCollapsed && window.innerWidth >= 1024)" x-transition.opacity class="truncate {{ app()->getLocale() === 'ar' ? 'mr-3' : 'ml-3' }}">{{ $item['label'] }}</span>
                        </a>
                    @endif
                @endforeach
            </nav>
        </div>
    </aside>
</div>

<script>
    function toggleTheme() {
        const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        document.documentElement.classList.remove(currentTheme);
        document.documentElement.classList.add(newTheme);
        localStorage.setItem('theme', newTheme);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const desktopThemeToggle = document.getElementById('theme-toggle-button');
        const desktopTopbarThemeToggle = document.getElementById('theme-toggle-button-desktop');
        const mobileThemeToggle = document.getElementById('theme-toggle-button-mobile');

        if (desktopThemeToggle) {
            desktopThemeToggle.addEventListener('click', toggleTheme);
        }

        if (desktopTopbarThemeToggle) {
            desktopTopbarThemeToggle.addEventListener('click', toggleTheme);
        }

        if (mobileThemeToggle) {
            mobileThemeToggle.addEventListener('click', toggleTheme);
        }
    });
</script>
