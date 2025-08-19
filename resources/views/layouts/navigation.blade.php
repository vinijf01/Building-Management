{{-- <nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white text-gray-900 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="text-3xl font-bold font-heading">
                    Logo Here.
                </a>
            </div>

            <!-- Nav Links Desktop -->
            <ul class="hidden md:flex space-x-12 font-semibold">
                <li><a href="#" class="hover:text-gray-300">Home</a></li>
                <li><a href="{{ route('products.list') }}" class="hover:text-gray-300">Collections</a></li>
                <li><a href="#" class="hover:text-gray-300">Contact Us</a></li>
            </ul>

            <!-- Header Icons + Profile Dropdown Desktop -->
            <div class="hidden xl:flex items-center space-x-5">
                <a href="#" class="hover:text-gray-300">
                    <!-- Heart Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </a>
                <a href="#" class="relative flex items-center hover:text-gray-300">
                    <!-- Shopping Cart Icon with Ping -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute -top-1 left-4 flex">
                      <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
                    </span>
                </a>
                <!-- Profile Dropdown -->
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 hover:text-gray-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 bg-white text-gray-900 rounded-md shadow-lg py-1 z-20">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Responsive Hamburger -->
            <div class="flex items-center xl:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md hover:text-gray-300 focus:outline-none focus:ring focus:ring-gray-700">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div x-show="open" class="md:hidden bg-gray-900 text-white">
        <ul class="space-y-1 px-2 pt-2 pb-3">
            <li><a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-700">Home</a></li>
            <li><a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-700">Category</a></li>
            <li><a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-700">Collections</a></li>
            <li><a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-700">Contact Us</a></li>
        </ul>
        <div class="border-t border-gray-700 pt-4 pb-3 px-5">
            <div class="font-medium">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
            <a href="{{ route('profile.edit') }}" class="block mt-3 px-3 py-2 rounded-md hover:bg-gray-700">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-1">
                @csrf
                <button type="submit" class="block w-full text-left px-3 py-2 rounded-md hover:bg-gray-700">Log Out</button>
            </form>
        </div>
    </div>
</nav> --}}
<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white text-gray-900 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="text-3xl font-bold font-heading">
                    Logo Here.
                </a>
            </div>


            <!-- Nav Links Desktop -->
            <ul class="hidden md:flex space-x-12 font-semibold">
                <li><a href="#" class="hover:text-gray-300">Home</a></li>
                <li><a href="{{ route('products.list') }}" class="hover:text-gray-300">Collections</a></li>
                <li><a href="#" class="hover:text-gray-300">Contact Us</a></li>
            </ul>

            <!-- Right Section (Desktop) -->
            <div class="hidden xl:flex items-center space-x-5">
                <a href="#" class="hover:text-gray-300">
                    <!-- Heart Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </a>

                <a href="#" class="relative flex items-center hover:text-gray-300">
                    <!-- Shopping Cart Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute -top-1 left-4 flex">
                        <span
                            class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-pink-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
                    </span>
                </a>

                <!-- Auth Section -->
                @auth
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ url('/dashboard') }}" class="text-3xl font-bold font-heading">
                            Logo Here.
                        </a>
                    </div>
                    <!-- Dropdown -->
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center space-x-2 hover:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                            class="absolute right-0 mt-2 w-48 bg-white text-gray-900 rounded-md shadow-lg py-1 z-20">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login/Register -->
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
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

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden bg-gray-900 text-white">
        <ul class="space-y-1 px-2 pt-2 pb-3">
            <li><a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-700">Home</a></li>
            <li><a href="{{ route('products.list') }}"
                    class="block px-3 py-2 rounded-md hover:bg-gray-700">Collections</a></li>
            <li><a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-700">Contact Us</a></li>
        </ul>
        <div class="border-t border-gray-700 pt-4 pb-3 px-5">
            @auth
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                <a href="{{ route('profile.edit') }}"
                    class="block mt-3 px-3 py-2 rounded-md hover:bg-gray-700">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-md hover:bg-gray-700">
                        Log Out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md hover:bg-gray-700">Login</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md hover:bg-gray-700">Register</a>
            @endauth
        </div>
    </div>
</nav>
