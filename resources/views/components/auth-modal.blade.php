<div x-data x-init="@if ($errors->any()) @if ($errors->has('name') || $errors->has('phone_number') || $errors->has('password_confirmation'))
                $store.auth.openRegister = true
            @elseif($errors->has('email') || $errors->has('password'))
                $store.auth.openLogin = true @endif
@endif">

    <!-- Modal Login -->
    <div x-show="$store.auth.openLogin" x-cloak @click.self="$store.auth.openLogin = false"
        @keydown.escape.window="$store.auth.openLogin = false"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6 m-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Welcome Back 👋</h2>
                <button @click="$store.auth.openLogin = false" type="button"
                    class="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100">✖</button>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="my-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror" />

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="my-4">
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror" />
                </div>
                <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                <button type="submit"
                    class="w-full bg-blue-600 text-white my-4 py-2 px-4 rounded-lg hover:bg-blue-700">
                    Login
                </button>
            </form>


            <p class="mt-4 text-center text-sm text-gray-600">
                Don't have an account?
                <button @click="$store.auth.openLogin = false; $store.auth.openRegister = true" type="button"
                    class="text-blue-600 hover:underline">Sign up</button>
            </p>
            <p class="text-xs text-center text-gray-600 my-4">
                By continuing, you agree to these Terms & Conditions and acknowledge that you have been informed about
                our Privacy Notice.
            </p>
        </div>
    </div>

    <!-- Modal Register -->
    <div x-show="$store.auth.openRegister" x-cloak @click.self="$store.auth.openRegister = false"
        @keydown.escape.window="$store.auth.openRegister = false"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6 m-4">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Create Account ✨</h2>
                <button @click="$store.auth.openRegister = false" type="button"
                    class="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100">✖</button>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium">Name</label>
                    <input id="name" name="name" type="text" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="phone_number" class="block text-sm font-medium">Phone Number</label>
                        <input id="phone_number" name="phone_number" type="text" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        @error('phone_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input id="email" name="email" type="email" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white my-4 py-2 px-4 rounded-lg hover:bg-blue-700">
                    Register
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Already have an account?
                <button @click="$store.auth.openRegister = false; $store.auth.openLogin = true" type="button"
                    class="text-blue-600 hover:underline">Log in</button>
            </p>
            <p class="text-xs text-center text-gray-600 my-4">
                By continuing, you agree to these Terms & Conditions and acknowledge that you have been informed about
                our Privacy Notice.
            </p>
        </div>
    </div>
</div>
