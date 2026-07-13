<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Admin') }}</title>

    <!-- Fonts & Scripts (Laravel Breeze/Jetstream Multi-auth အတွက်) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">

        <!-- Navigation Bar START -->
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed w-full top-0 z-50 shadow-sm">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <!-- Dashboard Link -->
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Home') }}
                            </x-nav-link>

                            <!-- Division Link -->
                            <x-nav-link :href="route('admin.divisions.index')" :active="request()->routeIs('admin.divisions.*')">
                                {{ __('Division') }}
                            </x-nav-link>

                            <!-- District Link -->
                            <x-nav-link :href="route('admin.districts.index')" :active="request()->routeIs('admin.districts.*')">
                                {{ __('District') }}
                            </x-nav-link>

                            <!-- Township Link -->
                            <x-nav-link :href="route('admin.townships.index')" :active="request()->routeIs('admin.townships.*')">
                                {{ __('Township') }}
                            </x-nav-link>

                            <!-- Pagoda Link -->
                            <x-nav-link :href="route('admin.pagodas.index')" :active="request()->routeIs('admin.pagodas.*')">
                                {{ __('Pagoda') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <!-- User နာမည်မရှိရင် Guest လို့ပြပြီး Error တက်ခြင်းကို Nullsafe (?->) ဖြင့် ကာကွယ်ထားသည် -->
                                    <div>{{ Auth::user()?->name ?? 'Guest Admin' }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
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
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <!-- Hamburger Menu (Mobile ဖြစ်သွားရင် ပေါ်မည့်ခလုတ်) -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu (Mobile View) -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Home') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('admin.divisions.index')" :active="request()->routeIs('admin.divisions.*')">
                        {{ __('Division') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="'#'">
                        {{ __('District') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="'#'">
                        {{ __('Township') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="'#'">
                        {{ __('Pagoda') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        </nav>
        <!-- Navigation Bar END -->

        <!-- Main Content Area ($slot အစား contents ထည့်ရန်နေရာ) -->
        <main class="pt-2 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 min-h-[500px]">
                @yield('content')
            </div>
        </main>

    </div>
</body>

</html>
