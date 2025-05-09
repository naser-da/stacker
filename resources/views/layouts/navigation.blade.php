<nav x-data="{ open: false, darkMode: localStorage.getItem('darkMode') === 'true' }" 
     x-init="$watch('darkMode', val => {
        localStorage.setItem('darkMode', val);
        if (val) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
     })"
     class="bg-white dark:bg-[#2d2e31] border-b border-gray-200 dark:border-[#3c4043] sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <x-application-logo class="block h-8 w-auto fill-current text-[#1a73e8] dark:text-[#8ab4f8]" />
                        <span class="text-xl font-medium text-[#202124] dark:text-[#e8eaed]">{{ config('app.name', 'Stacker') }}</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200">
                        {{ __('Categories') }}
                    </x-nav-link>

                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200">
                        {{ __('Products') }}
                    </x-nav-link>

                    <x-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')" class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200">
                        {{ __('Customers') }}
                    </x-nav-link>

                    <x-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')" class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200">
                        {{ __('Sales') }}
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="px-3 py-2 text-sm font-medium rounded-md transition-colors duration-200">
                        {{ __('Users') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none transition duration-150 ease-in-out">
                                <div class="flex items-center space-x-2">
                                    <div class="h-8 w-8 rounded-full bg-[#1a73e8] dark:bg-[#8ab4f8] flex items-center justify-center text-white dark:text-[#202124]">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->name }} ({{ Auth::user()->is_admin ? 'Admin' : 'User' }})
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700"></div>

                            <!-- Dark Mode Toggle -->
                            <div class="px-4 py-2">
                                <button @click="darkMode = !darkMode" class="flex items-center justify-between w-full text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md px-2 py-1.5 transition-colors duration-150 ease-in-out">
                                    <span class="flex items-center">
                                        <svg x-show="!darkMode" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                        </svg>
                                        <svg x-show="darkMode" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span x-text="darkMode ? 'Light Mode' : 'Dark Mode'"></span>
                                    </span>
                                    <div class="relative inline-block w-10 mr-2 align-middle select-none">
                                        <div class="block w-10 h-6 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                                        <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-200 ease-in-out"
                                             :class="{'translate-x-4': darkMode}"></div>
                                    </div>
                                </button>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700"></div>

                            <x-dropdown-link :href="route('settings.show')" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                {{ __('Company Settings') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-gray-700"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-4 py-2 text-base font-medium">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')" class="block px-4 py-2 text-base font-medium">
                {{ __('Categories') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" class="block px-4 py-2 text-base font-medium">
                {{ __('Products') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('customers.index')" :active="request()->routeIs('customers.*')" class="block px-4 py-2 text-base font-medium">
                {{ __('Customers') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')" class="block px-4 py-2 text-base font-medium">
                {{ __('Sales') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="block px-4 py-2 text-base font-medium">
                {{ __('Users') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 rounded-full bg-[#1a73e8] dark:bg-[#8ab4f8] flex items-center justify-center text-white dark:text-[#202124]">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Dark Mode Toggle (Mobile) -->
                <div class="px-4 py-2">
                    <button @click="darkMode = !darkMode" class="flex items-center justify-between w-full text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md px-2 py-1.5 transition-colors duration-150 ease-in-out">
                        <span class="flex items-center">
                            <svg x-show="!darkMode" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                            <svg x-show="darkMode" class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span x-text="darkMode ? 'Light Mode' : 'Dark Mode'"></span>
                        </span>
                        <div class="relative inline-block w-10 mr-2 align-middle select-none">
                            <div class="block w-10 h-6 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
                            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-200 ease-in-out"
                                 :class="{'translate-x-4': darkMode}"></div>
                        </div>
                    </button>
                </div>

                @if(Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('settings.show')" class="block px-4 py-2 text-base font-medium">
                        {{ __('Company Settings') }}
                    </x-responsive-nav-link>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="block px-4 py-2 text-base font-medium">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav> 