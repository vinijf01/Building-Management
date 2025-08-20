<x-app-layout>
    <div class="pt-4 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcrumbs :links="[
            ['label' => 'Home', 'url' => route('dashboard')],
            ['label' => 'Products', 'url' => ''],
            
        ]" />
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <section>
                    <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
                        <header>
                            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Rooms Collection</h2>

                            {{-- <p class="mt-4 max-w-md text-gray-500">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque praesentium cumque iure
                                dicta incidunt est ipsam, officia dolor fugit natus?
                            </p> --}}
                        </header>

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
                            <div class="hidden space-y-4 lg:block">
                                <!-- Sort By Price -->
                                <div>
                                    <label for="sort-price" class="block text-xs font-medium text-gray-700">Sort By
                                        Price</label>
                                    <select id="sort-price" class="mt-1 rounded-sm border-gray-300 text-sm w-full">
                                        <option value="asc">Low to High</option>
                                        <option value="desc">High to Low</option>
                                    </select>
                                </div>

                                <!-- Room Type Filter -->
                                <details
                                    class="overflow-hidden rounded-sm border border-gray-300 [&_summary::-webkit-details-marker]:hidden mt-4">
                                    <summary
                                        class="flex cursor-pointer items-center justify-between gap-2 p-4 text-gray-900 transition">
                                        <span class="text-sm font-medium">Room Type</span>
                                        <span class="transition group-open:-rotate-180">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </summary>
                                    <div class="border-t border-gray-200 bg-white p-4">
                                        <ul class="space-y-1">
                                            <li>
                                                <label class="inline-flex items-center gap-2">
                                                    <input type="radio" name="room_type" value="regular"
                                                        class="size-5 rounded-sm border-gray-300 shadow-sm">
                                                    <span class="text-sm font-medium text-gray-700">Regular</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="inline-flex items-center gap-2">
                                                    <input type="radio" name="room_type" value="exclusive"
                                                        class="size-5 rounded-sm border-gray-300 shadow-sm">
                                                    <span class="text-sm font-medium text-gray-700">Exclusive</span>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </span>
                                    </summary>
                                    <div class="border-t border-gray-200 bg-white p-4">
                                        <div class="flex justify-between gap-4">
                                            <label for="price-from" class="flex items-center gap-2 w-full">
                                                <span class="text-sm text-gray-600">$</span>
                                                <input type="number" id="price-from" placeholder="From"
                                                    class="w-full rounded-md border-gray-200 shadow-xs sm:text-sm">
                                            </label>
                                            <label for="price-to" class="flex items-center gap-2 w-full">
                                                <span class="text-sm text-gray-600">$</span>
                                                <input type="number" id="price-to" placeholder="To"
                                                    class="w-full rounded-md border-gray-200 shadow-xs sm:text-sm">
                                            </label>
                                        </div>
                                    </div>
                                </details>
                            </div>


                            <div class="lg:col-span-3">
                                <div id="category-apartment"
                                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach ([
        (object)
[
            'title' => 'Modern City Apartment',
            'description' => 'Spacious and modern 2-bedroom apartment in the city center.',
            'bedrooms' => 2,
            'price' => 1200,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Cozy Studio Apartment',
            'description' => 'Perfect for singles or couples, close to public transport.',
            'bedrooms' => 1,
            'price' => 800,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Luxury Downtown Loft',
            'description' => 'High ceilings and great city views with 3 bedrooms.',
            'bedrooms' => 3,
            'price' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Luxury Downtown Loft',
            'description' => 'High ceilings and great city views with 3 bedrooms.',
            'bedrooms' => 3,
            'price' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Luxury Downtown Loft',
            'description' => 'High ceilings and great city views with 3 bedrooms.',
            'bedrooms' => 3,
            'price' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Luxury Downtown Loft',
            'description' => 'High ceilings and great city views with 3 bedrooms.',
            'bedrooms' => 3,
            'price' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Luxury Downtown Loft',
            'description' => 'High ceilings and great city views with 3 bedrooms.',
            'bedrooms' => 3,
            'price' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
    ] as $apartment)
                                        <div
                                            class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                                            <div class="relative h-48">
                                                <img src="{{ $apartment->image_url }}" alt="{{ $apartment->title }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="p-5">
                                                <h3 class="text-xl font-semibold mb-2">{{ $apartment->title }}</h3>
                                                <p class="text-gray-600 mb-3 line-clamp-2">
                                                    {{ $apartment->description }}</p>
                                                <div class="flex justify-between items-center mb-4">
                                                    <span class="text-gray-800 font-medium">Bedrooms:
                                                        {{ $apartment->bedrooms }}</span>
                                                    <span
                                                        class="text-blue-600 font-bold text-lg">${{ $apartment->price }}</span>
                                                </div>
                                                <button
                                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition duration-200">
                                                    Book Now
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
