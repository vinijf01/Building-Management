<x-app-layout>
    <div class="py-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="relative rounded-2xl overflow-hidden">
                <!-- Background image full -->
                <div
                    class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center">
                </div>

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
                            <a href="#categoryTabs">
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition">
                                    Find out more
                                </button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <section id="categoryTabs" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex mt-6 mb-12 border-b-0">
                <button id="btn-apartment" class="w-1/2 px-6 py-2 font-semibold border-b-2 focus:outline-none"
                    onclick="showCategory('apartment')">Eksklusif</button>
                <button id="btn-kost" class="w-1/2 px-6 py-2 font-semibold border-b-2 focus:outline-none"
                    onclick="showCategory('kost')">Reguler</button>
            </div>


            <!-- Listings -->
            <div>
                <!-- Apartment Category -->
                <div id="category-apartment" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($eksklusif as $unit)
                        <x-cards :title="$unit->name" :description="$unit->description" :price="$unit->price" :image-url="$unit->cover_image
                            ? asset('storage/' . $unit->cover_image)
                            : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80'"
                            :button-url="route('detail', $unit->slug)" />
                    @endforeach
                </div>


                <!-- Kost Category (hidden by default) -->
                <div id="category-kost" class="hidden grid mb-12 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($reguler as $unit)
                        <x-cards :title="$unit->name" :description="$unit->description" :price="$unit->price" :image-url="$unit->cover_image
                            ? asset('storage/' . $unit->cover_image)
                            : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80'"
                            :button-url="route('detail', $unit->slug)" />
                    @endforeach
                </div>
                <div class="flex mb-12 items-center justify-center space-x-2 my-8">
                    <!-- Teks kiri -->
                    <span class="text-gray-900">Explore More</span>

                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-gray-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>

                    <!-- Link kanan -->
                    <a href="{{ route('products.list') }}" class="font-semibold underline text-gray-900 hover:text-blue-600">
                        View Collection
                    </a>
                </div>


            </div>

        </section>

        <section class="max-w-7xl mt-24 mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Best Deals for You
                </h2>
            </div>
            <div class="pb-4">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper mb-12">
                        @foreach ($all as $unit)
                            <div class="swiper-slide">
                                <x-cards :title="$unit->title" :description="$unit->description" :price="$unit->price" :image-url="$unit->cover_image
                                    ? asset('storage/' . $unit->cover_image)
                                    : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80'"
                                    :button-url="route('detail', $unit->slug)" />
                            </div>
                        @endforeach
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Why book with Us?
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="flex items-start space-x-4 p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-11 8h12a2 2 0 002-2V7a2 2 0
                       00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white">Easy changes</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Cancel or change your booking without hassle.
                        </p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="flex items-start space-x-4 p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.389 0
                       4.611.556 6.879 2.804M15 11a3 3 0 11-6 0
                       3 3 0 016 0z" />
                    </svg>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white">Travel made easy</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Exclusive extras, discounts and perks.
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="flex items-start space-x-4 p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white">24/7 customer support</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Reach out to us anytime, anywhere.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Frequently Asked Questions
                </h2>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item -->
                <div x-data="{ open: false }" class="border rounded-lg bg-white dark:bg-gray-800 shadow">
                    <button @click="open = !open"
                        class="w-full flex justify-between items-center p-4 text-left font-medium text-gray-900 dark:text-gray-200">
                        <span>How do I change or cancel my booking?</span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform text-gray-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="p-4 text-gray-600 dark:text-gray-400">
                        You can easily cancel or change your booking by visiting your booking details page or contacting
                        our support team.
                    </div>
                </div>

                <!-- FAQ Item -->
                <div x-data="{ open: false }" class="border rounded-lg bg-white dark:bg-gray-800 shadow">
                    <button @click="open = !open"
                        class="w-full flex justify-between items-center p-4 text-left font-medium text-gray-900 dark:text-gray-200">
                        <span>Do you offer 24/7 customer support?</span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform text-gray-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="p-4 text-gray-600 dark:text-gray-400">
                        Yes, our customer support team is available 24/7 to assist you with any inquiries.
                    </div>
                </div>

                <!-- FAQ Item -->
                <div x-data="{ open: false }" class="border rounded-lg bg-white dark:bg-gray-800 shadow">
                    <button @click="open = !open"
                        class="w-full flex justify-between items-center p-4 text-left font-medium text-gray-900 dark:text-gray-200">
                        <span>Are there any special discounts available?</span>
                        <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 transition-transform text-gray-500"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="p-4 text-gray-600 dark:text-gray-400">
                        Absolutely! We frequently provide exclusive deals, seasonal discounts, and promo codes for our
                        customers.
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-center space-x-2 my-8">
                <!-- Teks kiri -->
                <span class="text-gray-900">Discover More</span>

                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 text-gray-900">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>

                <!-- Link kanan -->
                <a href="#" class="font-semibold underline text-gray-900 hover:text-blue-600">
                    View FAQ
                </a>
            </div>
        </section>

        <!-- Search Section Before Footer -->
        <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24">
            <!-- Background image -->
            <div class="relative rounded-2xl mb-12 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80"
                    alt="Coliving and Apartment" class="absolute inset-0 w-full h-full object-cover" />

                <!-- Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-40"></div>

                <!-- Content -->
                <div class="relative flex flex-col items-center justify-center text-center py-24 px-6">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-6">
                        Find coliving and apartment for you
                    </h2>

                    <!-- Search Bar -->
                    <form action="{{ route('products.list') }}" method="GET" class="w-full max-w-lg">
                        <div class="flex bg-white rounded-lg overflow-hidden shadow-lg">
                            <input type="text" name="q"
                                placeholder="Search by location, property, or keyword..."
                                class="w-full px-4 py-3 text-gray-700 focus:outline-none" />
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>







        <script>
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
