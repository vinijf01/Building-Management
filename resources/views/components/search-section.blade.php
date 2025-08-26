<div class="relative rounded-2xl mb-12 overflow-hidden">
    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80"
        alt="Coliving and Apartment" class="absolute inset-0 w-full h-full object-cover" />

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <!-- Content -->
    <div class="relative flex flex-col items-center justify-center text-center py-24 px-6">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-6">
            {{ $title ?? 'Find coliving and apartment for you' }}
        </h2>

        <!-- Search Bar -->
        <form action="{{ $action ?? route('products.list') }}" method="GET" class="w-full max-w-lg">
            <div class="flex bg-white rounded-lg overflow-hidden shadow-lg">
                <input type="text" name="q"
                    placeholder="{{ $placeholder ?? 'Search by location, property, or keyword...' }}"
                    class="w-full px-4 py-3 text-gray-700 focus:outline-none" />
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3">
                    {{ $button ?? 'Search' }}
                </button>
            </div>
        </form>
    </div>
</div>
