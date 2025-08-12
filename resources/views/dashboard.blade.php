<x-app-layout>
    <div class="py-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="py-10 bg-white dark:bg-gray-900 rounded-2xl">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center space-y-8 md:space-y-0 md:space-x-12">
                    <div class="flex-[2] max-w-2xl">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 font-semibold">Guests</p>
                        <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight">
                            Discover the Best<br />Place Welcome!
                        </h1>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">
                            The way up to the top of the place is always no longer than you think
                        </p>
                        <div class="flex items-center space-x-4">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition">
                                Find out more
                            </button>
                            <button class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-red-500 font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-6.518-3.758A.75.75 0 007 8.845v6.31a.75.75 0 001.234.643l6.518-3.758a.75.75 0 000-1.322z" />
                                </svg>
                                <span>Play Demo</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex-1 max-w-md">
                        <img src="{{ asset('img/apartment1.svg') }}" alt="Travelers" class="rounded-2xl w-full object-cover" />
                    </div>
                </div>
            </div>

            <!-- Category Tabs -->
            <!-- <div class="flex justify-center space-x-6 my-6">
                <button id="btn-apartment" class="px-6 py-2 rounded-full font-semibold bg-gray-900 text-white dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="showCategory('apartment')">Apartment</button>
                <button id="btn-kost" class="px-6 py-2 rounded-full font-semibold bg-gray-300 text-gray-700 dark:bg-gray-600 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="showCategory('kost')">Kost</button>
            </div> -->
            
            

            {{-- <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Domestic Flight Best Deals for You ✈️
            </h2>
            </div> --}}
            <div class="flex my-6 border-b-0">
                <button id="btn-apartment"
                    class="w-1/2 px-6 py-2 font-semibold border-b-2 focus:outline-none"
                    onclick="showCategory('apartment')">Apartment</button>
                <button id="btn-kost"
                    class="w-1/2 px-6 py-2 font-semibold border-b-2 focus:outline-none"
                    onclick="showCategory('kost')">Kost</button>
            </div>



            <!-- Listings -->
            <div>
                <!-- Apartment Category -->
                <div id="category-apartment" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ([
                        (object)[
                            'title' => 'Modern City Apartment',
                            'description' => 'Spacious and modern 2-bedroom apartment in the city center.',
                            'bedrooms' => 2,
                            'price' => 1200,
                            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object)[
                            'title' => 'Cozy Studio Apartment',
                            'description' => 'Perfect for singles or couples, close to public transport.',
                            'bedrooms' => 1,
                            'price' => 800,
                            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object)[
                            'title' => 'Luxury Downtown Loft',
                            'description' => 'High ceilings and great city views with 3 bedrooms.',
                            'bedrooms' => 3,
                            'price' => 2500,
                            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
                        ],
                    ] as $apartment)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <img src="{{ $apartment->image_url }}" alt="{{ $apartment->title }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $apartment->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ $apartment->description }}</p>
                                <div class="flex justify-between items-center text-sm text-gray-700 dark:text-gray-300 mb-3">
                                    <span>{{ $apartment->bedrooms }} Bedrooms</span>
                                    <span>${{ $apartment->price }} / month</span>
                                </div>
                                <button class="w-full bg-blue-500 text-white rounded-md py-2 hover:bg-blue-600 transition">Book Now</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Kost Category (hidden by default) -->
                <div id="category-kost" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ([
                        (object)[
                            'title' => 'Affordable Kost Near Campus',
                            'description' => 'Clean and safe kost for students, includes Wi-Fi and utilities.',
                            'bedrooms' => 1,
                            'price' => 300,
                            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object)[
                            'title' => 'Female-only Kost with AC',
                            'description' => 'Quiet and comfortable rooms with AC and laundry services.',
                            'bedrooms' => 1,
                            'price' => 450,
                            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object)[
                            'title' => 'Shared Kost House',
                            'description' => 'Large house with shared bedrooms and communal kitchen.',
                            'bedrooms' => 2,
                            'price' => 350,
                            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80',
                        ],
                    ] as $kost)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <img src="{{ $kost->image_url }}" alt="{{ $kost->title }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $kost->title }}</h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ $kost->description }}</p>
                                <div class="flex justify-between items-center text-sm text-gray-700 dark:text-gray-300 mb-3">
                                    <span>{{ $kost->bedrooms }} Bedrooms</span>
                                    <span>${{ $kost->price }} / month</span>
                                </div>
                                <button class="w-full bg-gray-900 text-white rounded-md py-2 hover:bg-gray-700 transition">Book Now</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        // function showCategory(category) {
        //     const apartmentSection = document.getElementById('category-apartment');
        //     const kostSection = document.getElementById('category-kost');
        //     const btnApartment = document.getElementById('btn-apartment');
        //     const btnKost = document.getElementById('btn-kost');

        //     if (category === 'apartment') {
        //         apartmentSection.classList.remove('hidden');
        //         kostSection.classList.add('hidden');
        //         btnApartment.classList.add('bg-gray-900', 'text-white');
        //         btnApartment.classList.remove('bg-gray-300', 'text-gray-700');
        //         btnKost.classList.remove('bg-gray-900', 'text-white');
        //         btnKost.classList.add('bg-gray-300', 'text-gray-700');
        //     } else {
        //         apartmentSection.classList.add('hidden');
        //         kostSection.classList.remove('hidden');
        //         btnKost.classList.add('bg-gray-900', 'text-white');
        //         btnKost.classList.remove('bg-gray-300', 'text-gray-700');
        //         btnApartment.classList.remove('bg-gray-900', 'text-white');
        //         btnApartment.classList.add('bg-gray-300', 'text-gray-700');
        //     }
        // }
        function showCategory(category) {
            const apartmentSection = document.getElementById('category-apartment');
            const kostSection = document.getElementById('category-kost');
            const btnApartment = document.getElementById('btn-apartment');
            const btnKost = document.getElementById('btn-kost');

            if (category === 'apartment') {
                apartmentSection.classList.remove('hidden');
                kostSection.classList.add('hidden');

                btnApartment.classList.add('border-blue-600', 'text-blue-600');
                btnApartment.classList.remove('border-transparent', 'text-gray-600', 'dark:text-gray-400');

                btnKost.classList.remove('border-blue-600', 'text-blue-600');
                btnKost.classList.add('border-transparent', 'text-gray-600', 'dark:text-gray-400');
            } else {
                apartmentSection.classList.add('hidden');
                kostSection.classList.remove('hidden');

                btnKost.classList.add('border-blue-600', 'text-blue-600');
                btnKost.classList.remove('border-transparent', 'text-gray-600', 'dark:text-gray-400');

                btnApartment.classList.remove('border-blue-600', 'text-blue-600');
                btnApartment.classList.add('border-transparent', 'text-gray-600', 'dark:text-gray-400');
            }
        }

        // On load initialize with transparent border for inactive tabs
        document.addEventListener('DOMContentLoaded', () => {
            // Set initial border-transparent to both first
            const btnApartment = document.getElementById('btn-apartment');
            const btnKost = document.getElementById('btn-kost');
            btnApartment.classList.add('border-transparent');
            btnKost.classList.add('border-transparent');

            showCategory('apartment');
        });



        // Initialize default category on page load
        document.addEventListener('DOMContentLoaded', () => {
            showCategory('apartment');
        });
    </script>
</x-app-layout>
