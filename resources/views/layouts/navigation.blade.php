<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 shadow-md border-b border-gray-200 dark:border-gray-700">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- LEFT: APP TITLE -->
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-600 text-white shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                </div>

                <span class="text-2xl font-bold tracking-wide text-gray-800 dark:text-gray-200">
                    Admin Dashboard
                </span>
            </div>

            <!-- RIGHT SECTION -->
            <div class="hidden sm:flex items-center space-x-4">

                <!-- Pesan Masuk -->
                <a href="#" class="relative p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">

                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>

                    <span
                        class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                        3
                    </span>
                </a>

                <!-- USER DROPDOWN -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center space-x-2 px-4 py-2 bg-gray-100 dark:bg-gray-800
                                       text-gray-700 dark:text-gray-300 font-medium rounded-lg shadow-sm
                                       hover:bg-gray-200 dark:hover:bg-gray-700 transition">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                                class="w-8 h-8 rounded-full shadow" />

                            <span>{{ Auth::user()->name }}</span>

                            <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="{{ route('profile.edit') }}">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

            </div>

            <!-- MOBILE BUTTON -->
            <button
                class="sm:hidden p-2 rounded-md text-gray-500 dark:text-gray-400
                           hover:bg-gray-100 dark:hover:bg-gray-800 transition"
                @click="open = ! open">

                <svg class="h-6 w-6" fill="none" stroke="currentColor">
                    <path :class="{ 'hidden': open, 'block': !open }" class="block" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'block': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>
    </div>

    <!-- MOBILE MENU -->
    <div :class="{ 'block': open, 'hidden': !open }"
        class="hidden sm:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">

        <div class="px-4 pt-4 pb-3">
            <div class="flex items-center space-x-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff"
                    class="w-10 h-10 rounded-full shadow" />
                <div>
                    <p class="text-gray-800 dark:text-gray-200 font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <div class="mt-2 space-y-1 border-t border-gray-200 dark:border-gray-700">

            <x-responsive-nav-link href="#">
                Profile
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    Log Out
                </x-dropdown-link>
            </form>
        </div>
    </div>

</nav>
