{{-- <x-guest-layout>
    <!-- Header -->
    <h2 class="text-2xl font-bold text-center text-gray-800 dark:text-white">Welcome Back 👋</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400 text-center mb-6">Login to your account</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg" type="email" name="email"
                :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-lg"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember + Forgot -->
        <div class="flex items-center justify-between text-sm">
            <label class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded text-indigo-600 border-gray-300 focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <x-primary-button class="w-full justify-center">
            {{ __('Log in') }}
        </x-primary-button>
    </form>

    <!-- Register Link -->
    <p class="text-sm text-center text-gray-600 dark:text-gray-400 mt-6">
        Don’t have an account?
        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">
            Register here
        </a>
    </p>
</x-guest-layout> --}}

<div x-show="openLogin" 
     x-cloak 
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative">
        <button @click="openLogin = false" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">&times;</button>
        
        <h2 class="text-2xl font-semibold mb-4">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full mt-1 p-2 border rounded-md" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" name="password" id="password" class="w-full mt-1 p-2 border rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</div>
