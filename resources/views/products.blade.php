<x-app-layout>
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcrumbs :links="[['label' => 'Home', 'url' => route('dashboard')], ['label' => 'Products', 'url' => '']]" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section>
                    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
                        <header>
                            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Product Collection</h2>
                            <p class="mt-4 max-w-md text-gray-500">
                                Temukan properti terbaik sesuai kebutuhan Anda.
                            </p>
                        </header>

                        <!-- Mobile Filter Button -->
                        <div class="mt-8 block lg:hidden">
                            <button
                                class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600">
                                <span class="text-sm font-medium"> Filters & Sorting </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4 rtl:rotate-180">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div>

                        <div class="mt-4 lg:mt-8 lg:grid lg:grid-cols-4 lg:items-start lg:gap-8">
                            <!-- Sidebar Filter -->
                            <div class="hidden space-y-4 lg:block">
                                <form method="GET" action="{{ route('products.list') }}">
                                    <!-- Sort By Price -->
                                    <div>
                                        <label for="sort-price" class="block text-xs font-medium text-gray-700">Sort By
                                            Price</label>
                                        <select id="sort-price" name="sort_price"
                                            class="mt-1 rounded-sm border-gray-300 text-sm w-full">
                                            <option value="asc"
                                                {{ request('sort_price') == 'asc' ? 'selected' : '' }}>Low to High
                                            </option>
                                            <option value="desc"
                                                {{ request('sort_price') == 'desc' ? 'selected' : '' }}>High to Low
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Room Type Filter -->
                                    <details
                                        class="overflow-hidden rounded-sm border border-gray-300 [&_summary::-webkit-details-marker]:hidden mt-4">
                                        <summary
                                            class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition">
                                            <span class="text-sm font-medium">Room Type</span>
                                            <span class="transition group-open:-rotate-180">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </span>
                                        </summary>
                                        <div class="border-t border-gray-200 bg-white p-4">
                                            <ul class="space-y-1">
                                                <li>
                                                    <label class="inline-flex items-center gap-2">
                                                        <input type="radio" name="room_type" value="reguler"
                                                            class="size-5 rounded-sm border-gray-300 shadow-sm"
                                                            {{ request('room_type') == 'reguler' ? 'checked' : '' }}>
                                                        <span class="text-sm font-medium text-gray-700">Reguler</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="inline-flex items-center gap-2">
                                                        <input type="radio" name="room_type" value="eksklusif"
                                                            class="size-5 rounded-sm border-gray-300 shadow-sm"
                                                            {{ request('room_type') == 'eksklusif' ? 'checked' : '' }}>
                                                        <span class="text-sm font-medium text-gray-700">Eksklusif</span>
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </details>

                                    <!-- Price Filter -->
                                    <details
                                        class="overflow-hidden rounded-sm border border-gray-300 [&_summary::-webkit-details-marker]:hidden mt-4">
                                        <summary
                                            class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition">
                                            <span class="text-sm font-medium">Price</span>
                                            <span class="transition group-open:-rotate-180">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </span>
                                        </summary>
                                        <div class="border-t border-gray-200 bg-white p-4">
                                            <div class="flex justify-between gap-4">
                                                <label for="price-from" class="flex items-center gap-2 w-full">
                                                    <span class="text-sm text-gray-600">$</span>
                                                    <input type="number" id="price-from" name="price_from"
                                                        placeholder="From" value="{{ request('price_from') }}"
                                                        class="w-full rounded-md border-gray-200 shadow-xs sm:text-sm">
                                                </label>
                                                <label for="price-to" class="flex items-center gap-2 w-full">
                                                    <span class="text-sm text-gray-600">$</span>
                                                    <input type="number" id="price-to" name="price_to"
                                                        placeholder="To" value="{{ request('price_to') }}"
                                                        class="w-full rounded-md border-gray-200 shadow-xs sm:text-sm">
                                                </label>
                                            </div>
                                        </div>
                                    </details>

                                    <button type="submit"
                                        class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                                        Apply Filters
                                    </button>
                                </form>
                            </div>


                            <!-- Product Grid -->
                            <div class="lg:col-span-3">
                                <div id="category-apartment"
                                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @forelse($all as $property)
                                        <div
                                            class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                                            <div class="relative h-48">
                                                <img src="{{ asset('storage/' . $property->cover_image) }}"
                                                    alt="{{ $property->name }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="p-5">
                                                <h3 class="text-xl font-semibold mb-2">{{ $property->name }}</h3>
                                                <p class="text-gray-600 mb-3 line-clamp-2">{{ $property->description }}
                                                </p>
                                                <div class="flex justify-between items-center mb-4">
                                                    <span class="text-gray-800 font-medium">Price:
                                                    </span>
                                                    <span
                                                        class="text-blue-600 font-bold text-lg">${{ number_format($property->price, 2) }}</span>
                                                </div>
                                                <a href="{{ route('booking.show', $property->slug) }}"
                                                    class="w-full block text-center bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                                                    Book Now
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 col-span-3">Tidak ada properti ditemukan.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
