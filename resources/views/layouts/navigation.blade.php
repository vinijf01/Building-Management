<!-- NAV -->
<nav x-data class="sticky top-0 z-50 bg-white text-gray-900 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            @auth
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-bold font-heading">
                        Building Management
                    </a>
                </div>
            @else
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-2xl font-bold font-heading">
                        Building Management
                    </a>
                </div>
            @endauth

            <!-- Nav Links Desktop -->
            <ul class="hidden md:flex space-x-12 font-semibold">
                <li>
                    <a href="{{ auth()->check() ? route('dashboard') : url('/') }}"
                        class="hover:text-blue-500 {{ (auth()->check() && request()->routeIs('dashboard')) || (!auth()->check() && request()->is('/')) ? 'text-blue-500' : 'text-gray-900' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.list') }}"
                        class="hover:text-blue-500 {{ request()->routeIs('products.list') ? 'text-blue-500' : 'text-gray-900' }}">
                        Collections
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact-us') }}"
                        class="hover:text-blue-500 {{ request()->routeIs('contact') ? 'text-blue-500' : 'text-gray-900' }}">
                        Contact Us
                    </a>
                </li>
            </ul>

            <!-- Right Section (Desktop) -->
            <div class="hidden xl:flex items-center space-x-5">
                @auth
                    <!-- Dropdown -->
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center space-x-2 hover:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ Auth::user()->name }}
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                            class="absolute right-0 mt-6 w-48 bg-white text-gray-900 rounded-md shadow-lg py-1 z-20">

                            <div class="px-4 py-2 text-gray-500 uppercase text-xs font-semibold">Transaction</div>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Transaction History</a>

                            <div class="border-t border-gray-200 my-1"></div>

                            <div class="px-4 py-2 text-gray-500 uppercase text-xs font-semibold">Settings</div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Log
                                    Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login/Register -->
                    <div class="flex space-x-4">
                        <button @click="$store.auth.openLogin = true; $store.auth.openRegister = false"
                            class="hover:text-gray-300">Login</button>
                        <button @click="$store.auth.openRegister = true; $store.auth.openLogin = false"
                            class="hover:text-gray-300">Register</button>
                    </div>

                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center xl:hidden">
                <button @click="open = !open" class="p-2 rounded-md hover:text-gray-300">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
