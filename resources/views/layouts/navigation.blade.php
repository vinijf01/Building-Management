
<!-- NAVBAR -->
<nav x-data="{ open: false, dropdownOpen: false }" class="sticky top-0 z-50 bg-white text-gray-900 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold font-heading">
                    Building Management
                </a>
            </div>

            <!-- Nav Links Desktop -->
            <ul class="hidden md:flex space-x-12 font-semibold">
                <li>
                    <a href="{{ route('home') }}"
                        class="hover:text-blue-500 {{ request()->is('home') ? 'text-blue-500' : 'text-gray-900' }}">
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
                    <a href="#"
                        class="hover:text-blue-500 {{ request()->routeIs('contact') ? 'text-blue-500' : 'text-gray-900' }}">
                        Contact Us
                    </a>
                </li>
            </ul>

            <!-- Right Section (Desktop) -->
            <div class="hidden xl:flex items-center space-x-5">
                @auth
                    <!-- Dropdown -->
                    <div class="relative" @click.away="dropdownOpen = false">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 hover:text-gray-300">
                            {{ Auth::user()->name }}
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="absolute right-0 mt-6 w-48 bg-white text-gray-900 rounded-md shadow-lg py-1 z-20">
                            <div class="px-4 py-2 text-gray-500 uppercase text-xs font-semibold">Transaction</div>
                            <a href="{{route('transactionHistory')}}" class="block px-4 py-2 hover:bg-gray-100">Transaction History</a>

                            <div class="border-t border-gray-200 my-1"></div>

                            <div class="px-4 py-2 text-gray-500 uppercase text-xs font-semibold">Settings</div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Log Out</button>
                            </form>
                        </div>
                    </div>
                @else
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

    <!-- Mobile Menu Overlay -->
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="absolute top-full left-0 w-full bg-white border-t border-gray-200 md:hidden z-50">
        <ul class="px-2 pt-2 pb-4 space-y-1 font-semibold">
            <li>
                <a href="{{ route('home') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->is('home') ? 'bg-blue-100 text-blue-500' : 'text-gray-900' }}">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('products.list') }}"
                    class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('products.list') ? 'bg-blue-100 text-blue-500' : 'text-gray-900' }}">
                    Collections
                </a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('contact') ? 'bg-blue-100 text-blue-500' : 'text-gray-900' }}">
                    Contact Us
                </a>
            </li>
            @auth
                <li class="border-t border-gray-200 pt-2 mt-2">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Transaction History</a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Log Out</button>
                    </form>
                </li>
            @else
                <li class="border-t border-gray-200 pt-2 mt-2">
                    <button @click="$store.auth.openLogin = true; $store.auth.openRegister = false"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100">Login</button>
                    <button @click="$store.auth.openRegister = true; $store.auth.openLogin = false"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100">Register</button>
                </li>
            @endauth
        </ul>
    </div>
</nav>
