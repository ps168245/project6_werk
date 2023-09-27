<nav x-data="{ open: false }" class="bg-green-700  ">
    <!-- Primary Navigation Menu -->
    <div class=" mx-auto px-1">
        <div class="flex justify-between h-16">
            <div class="flex w-full">


                <!-- Logo -->
                <div class="shrink-0 flex items-center w-24">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-px w-auto fill-current text-white" />
                    </a>
                </div>
                <!-- Navigation Links -->
                <div class="hidden md:flex sm:items-center sm:ml-6">
                    <a href="{{ route('contact') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        {{ __('Contact') }}
                    </a>
                </div>
            </div>
            <!-- Shopping Cart -->
            <div class=" flex items-center ml-auto mr-2">
                <a href="{{ route('shoppingcart.index') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
            <!-- Settings Dropdown -->

            @if(Auth::check())
            <div class="hidden md:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @unlesshasRole('klant')
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>
                        @endunless

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profiel') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('order_history')">
                            {{ __('Geschiedenis') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Afmelden') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else

            @if (Route::has('login'))
            <div class="hidden md:flex sm:items-center sm:ml-6">
                @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:bg-none focus:outline-red-500">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Aanmelden</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registeren</a>
                @endif
                @endauth
            </div>
            @endif

            @endif
            <!-- Hamburger -->
            <div class="flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">

            @if(Auth::check())
            @unlesshasRole('klant')
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') ">
                <div class="text-white ">{{ __('Dashboard') }}</div>
            </x-responsive-nav-link>
            @endunless
            @endif

            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                <div class="text-white">{{ __('Contact') }}</div>
            </x-responsive-nav-link>

            @if(Auth::check())
            <x-responsive-nav-link :href="route('order_history')" :active="request()->routeIs('order_history') ">
                <div class="text-white ">{{ __('Geschiedenis') }}</div>
            </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @if(Auth::check())

            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 ">
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    <div class="text-white">{{ __('Profiel') }}</div>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" :active="request()->routeIs('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        <div class="text-white">{{ __('Afmelden') }}</div>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @else
        <x-responsive-nav-link align="right" :href="route('login')">
            <div class="font-medium text-base text-white" :active="request()->routeIs('Aanmelden')">{{ __('Aanmelden') }}</div>
        </x-responsive-nav-link>
        @if (Route::has('register'))
        <x-responsive-nav-link align="right" :href="route('register')" :active="request()->routeIs('register')">
            <div class="font-medium text-base text-white">{{ __('Registeren') }}</div>
        </x-responsive-nav-link>
        @endif
        @endif
    </div>
</nav>