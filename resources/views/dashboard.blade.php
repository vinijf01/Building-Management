<x-app-layout>
    <div class="py-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Section -->
            {{-- <div class="py-10 bg-white dark:bg-gray-900 rounded-2xl">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row items-center space-y-8 md:space-y-0 md:space-x-12">
                    <div class="flex-[2] max-w-2xl">
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
            </div> --}}
            <div class="relative rounded-2xl overflow-hidden">
                <!-- Background image full -->
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center">
                </div>

                <!-- Mask fade putih di bawah -->
                {{-- <div
                    class="absolute inset-0 bg-gradient-to-t from-white via-white/80 to-transparent dark:from-gray-900 dark:via-gray-900/80">
                </div> --}}
                <div
                    class="absolute inset-0 bg-gradient-to-r from-white via-white/80 to-transparent dark:from-gray-900 dark:via-gray-900/80">
                </div>


                <!-- Konten -->
                <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-16 flex items-center">
                    <div class="max-w-2xl">
                        <h1 class="text-5xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight">
                            Discover the Best<br />Place Welcome!
                        </h1>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-8">
                            The way up to the top of the place is always no longer than you think
                        </p>
                        <div class="flex items-center space-x-4">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition">
                                Find out more
                            </button>
                            <button
                                class="flex items-center space-x-2 text-gray-700 dark:text-gray-300 hover:text-red-500 font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.752 11.168l-6.518-3.758A.75.75 0 007 8.845v6.31a.75.75 0 001.234.643l6.518-3.758a.75.75 0 000-1.322z" />
                                </svg>
                                <span>Play Demo</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Category Tabs -->
            <!-- <div class="flex justify-center space-x-6 my-6">
                <button id="btn-apartment" class="px-6 py-2 rounded-full font-semibold bg-gray-900 text-white dark:bg-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="showCategory('apartment')">Apartment</button>
                <button id="btn-kost" class="px-6 py-2 rounded-full font-semibold bg-gray-300 text-gray-700 dark:bg-gray-600 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" onclick="showCategory('kost')">Kost</button>
            </div> -->




            <div class="flex my-6 border-b-0">
                <button id="btn-apartment" class="w-1/2 px-6 py-2 font-semibold border-b-2 focus:outline-none"
                    onclick="showCategory('apartment')">Apartment</button>
                <button id="btn-kost" class="w-1/2 px-6 py-2 font-semibold border-b-2 focus:outline-none"
                    onclick="showCategory('kost')">Kost</button>
            </div>



            <!-- Listings -->
            <div>
                <!-- Apartment Category -->
                <!-- Apartment Category -->
                <div id="category-apartment" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ([
        (object)
[
            'title' => 'Modern City Apartment',
            'description' => 'Spacious and modern 2-bedroom apartment in the city center.',
            'price' => 1200,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Cozy Studio Apartment',
            'description' => 'Perfect for singles or couples, close to public transport.',
            'price' => 800,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Luxury Downtown Loft',
            'description' => 'High ceilings and great city views with 3 bedrooms.',
            'price' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Luxury Downtown Loft',
            'description' => 'High ceilings and great city views with 3 bedrooms.',
            'price' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ],
    ] as $apartment)
                        <x-cards :title="$apartment->title" :description="$apartment->description"  :price="$apartment->price"
                            :image-url="$apartment->image_url" button-text="Book Now" />
                    @endforeach
                </div>


                <!-- Kost Category (hidden by default) -->
                <div id="category-kost" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ([
        (object)
[
            'title' => 'Affordable Kost Near Campus',
            'description' => 'Clean and safe kost for students, includes Wi-Fi and utilities.',
            'price' => 300,
            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Female-only Kost with AC',
            'description' => 'Quiet and comfortable rooms with AC and laundry services.',
            'price' => 450,
            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Shared Kost House',
            'description' => 'Large house with shared bedrooms and communal kitchen.',
            'price' => 350,
            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80',
        ],
        (object) [
            'title' => 'Shared Kost House',
            'description' => 'Large house with shared bedrooms and communal kitchen.',
            'price' => 350,
            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80',
        ],
    ] as $kost)
                        <x-cards :title="$kost->title" :description="$kost->description" :price="$kost->price"
                            :image-url="$kost->image_url" button-text="Book Now" />
                    @endforeach
                </div>
                @php
                    $datas = collect([
                        (object) [
                            'title' => 'Modern City Apartment',
                            'description' => 'Spacious and modern 2-bedroom apartment in the city center.',
                            'price' => 1200,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Cozy Studio Apartment',
                            'description' => 'Perfect for singles or couples, close to public transport.',
                            'price' => 800,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1560448075-bb4caa6d7732?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Luxury Downtown Loft',
                            'description' => 'High ceilings and great city views with 3 bedrooms.',
                            'price' => 2500,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=600&q=80',
                        ],

                        (object) [
                            'title' => 'Minimalist Apartment',
                            'description' => 'Clean design with bright lighting and open space.',
                            'price' => 1000,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Penthouse Suite',
                            'description' => 'Breathtaking city skyline views from the rooftop.',
                            'price' => 5000,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Riverside Apartment',
                            'description' => 'Relax with the sound of water right outside your window.',
                            'price' => 1500,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1505691723518-36a5ac3be353?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Suburban Comfort',
                            'description' => 'Spacious apartment in a peaceful residential area.',
                            'price' => 1100,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1599420186946-7b6a8e0c1b4c?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Vintage Charm Apartment',
                            'description' => 'Retro style with modern amenities.',
                            'price' => 900,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1599420186946-7b6a8e0c1b4c?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Student Budget Apartment',
                            'description' => 'Affordable housing option for university students.',
                            'price' => 600,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1599420186946-7b6a8e0c1b4c?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Eco-Friendly Apartment',
                            'description' => 'Built with sustainable materials and solar panels.',
                            'price' => 1300,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1599420186946-7b6a8e0c1b4c?auto=format&fit=crop&w=600&q=80',

                        ],
                    ]);
                @endphp

                <div class="">
                    <div class="mt-8 mb-4">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Lorem Ipsum Best Deals for You ✈️
                        </h2>
                    </div>
                    <div class="pb-8">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper ">
                                @foreach ($datas as $apartment)
                                    <div
                                        class="swiper-slide my-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                        <x-cards :title="$apartment->title" :description="$apartment->description" 
                                            :price="$apartment->price" :image-url="$apartment->image_url" button-text="Book Now" />
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
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
