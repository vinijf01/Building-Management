<x-app-layout>
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcrumbs :links="[['label' => 'Home', 'url' => route('home')], ['label' => 'Products', 'url' => '']]" />

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
                        <div x-data="{ mobileFiltersOpen: false }" class="mt-8">
                            <!-- Mobile Filter Button -->
                            <div class="block lg:hidden">
                                <button @click="mobileFiltersOpen = !mobileFiltersOpen"
                                    class="flex cursor-pointer items-center gap-2 border-b border-gray-400 pb-1 text-gray-900 transition hover:border-gray-600">
                                    <span class="text-sm font-medium"> Filters & Sorting </span>
                                    <svg :class="{ 'rotate-90': mobileFiltersOpen }" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-4 transition-transform duration-200">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Mobile Filter Panel -->
                            <div x-show="mobileFiltersOpen" x-transition class="mt-4 space-y-4 lg:hidden">
                                <form method="GET" action="{{ route('products.list') }}">
                                    <!-- copy your filter fields from sidebar here -->
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
                                                    <span class="text-sm text-gray-600">Rp. </span>
                                                    <input type="number" id="price-from" name="price_from"
                                                        placeholder="From" value="{{ request('price_from') }}"
                                                        class="w-full rounded-md border-gray-200 shadow-xs sm:text-sm">
                                                </label>
                                                <label for="price-to" class="flex items-center gap-2 w-full">
                                                    <span class="text-sm text-gray-600">Rp. </span>
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
                                                        <span
                                                            class="text-sm font-medium text-gray-700">Eksklusif</span>
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
                                                    <span class="text-sm text-gray-600">Rp. </span>
                                                    <input type="number" id="price-from" name="price_from"
                                                        placeholder="From" value="{{ request('price_from') }}"
                                                        class="w-full rounded-md border-gray-200 shadow-xs sm:text-sm">
                                                </label>
                                                <label for="price-to" class="flex items-center gap-2 w-full">
                                                    <span class="text-sm text-gray-600">Rp. </span>
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
                                <!-- Search Bar -->
                                <div class="flex justify-end mb-6">
                                    <form action="{{ route('products.list') }}" method="GET"
                                        class="flex items-center w-full sm:w-1/3">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            placeholder="Search products..."
                                            class="w-full rounded-md border-gray-300 text-sm px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <button type="submit"
                                            class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                                            Search
                                        </button>
                                    </form>
                                </div>
                                <div id="category-apartment"
                                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @forelse($all as $property)
                                        <x-cards :title="$property->name" :description="$property->description" :price="$property->price" :image-url="$property->cover_image
                                            ? asset('storage/' . $property->cover_image)
                                            : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80'"
                                            :button-url="route('detail', $property->slug)" />

                                    @empty
                                        <p class="text-gray-500 col-span-3">Tidak ada properti ditemukan.</p>
                                    @endforelse
                                </div>
                                <div class="mt-8 w-full flex justify-end"> {{-- flex justify-end -> kanan --}}
                                    <nav class="inline-flex items-center space-x-1" aria-label="Pagination">

                                        {{-- Previous Page --}}
                                        @if ($all->onFirstPage())
                                            <span
                                                class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-md">Prev</span>
                                        @else
                                            <a href="{{ $all->previousPageUrl() }}"
                                                class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md">
                                                Prev
                                            </a>
                                        @endif

                                        {{-- Page Numbers with Ellipsis --}}
                                        @php
                                            $current = $all->currentPage();
                                            $last = $all->lastPage();
                                            $start = max(1, $current - 2);
                                            $end = min($last, $current + 2);
                                        @endphp

                                        {{-- Always show first page --}}
                                        @if ($start > 1)
                                            <a href="{{ $all->url(1) }}"
                                                class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md">1</a>
                                            @if ($start > 2)
                                                <span class="px-3 py-2 text-sm text-gray-500">...</span>
                                            @endif
                                        @endif

                                        {{-- Dynamic page range --}}
                                        @for ($i = $start; $i <= $end; $i++)
                                            @if ($i == $current)
                                                <span
                                                    class="px-3 py-2 text-sm bg-blue-500 text-white border border-blue-500 rounded-md">{{ $i }}</span>
                                            @else
                                                <a href="{{ $all->url($i) }}"
                                                    class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md">
                                                    {{ $i }}
                                                </a>
                                            @endif
                                        @endfor

                                        {{-- Always show last page --}}
                                        @if ($end < $last)
                                            @if ($end < $last - 1)
                                                <span class="px-3 py-2 text-sm text-gray-500">...</span>
                                            @endif
                                            <a href="{{ $all->url($last) }}"
                                                class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md">{{ $last }}</a>
                                        @endif

                                        {{-- Next Page --}}
                                        @if ($all->hasMorePages())
                                            <a href="{{ $all->nextPageUrl() }}"
                                                class="px-3 py-2 text-sm bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md">
                                                Next
                                            </a>
                                        @else
                                            <span
                                                class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-md">Next</span>
                                        @endif

                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
