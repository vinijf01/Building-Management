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

        </section>
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex my-6 border-b-0">
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
                        <x-cards :title="$unit->name" :description="$unit->description" :price="$unit->price" :image-url="asset('storage/' . $unit->cover_image)"
                            button-text="Book Now"  :button-url="route('book.now', $unit->slug)"/>
                    @endforeach
                </div>


                <!-- Kost Category (hidden by default) -->
                <div id="category-kost" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                     @foreach ($reguler as $unit)
                        <x-cards :title="$unit->name" :description="$unit->description" :price="$unit->price" :image-url="asset('storage/' . $unit->cover_image)"
                            button-text="Book Now" :button-url="route('book.now', $unit->slug)"/>
                    @endforeach
                </div>
            </div>

        </section>

       <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mt-8 mb-4">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Lorem Ipsum Best Deals for You ✈️
                </h2>
            </div>
            <div class="pb-8">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper ">
                        @foreach ($all as $unit)
                            <div
                                class="swiper-slide my-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                <x-cards :title="$unit->title" :description="$unit->description" 
                                    :price="$unit->price" :image-url="asset('storage/' . $unit->cover_image)" button-text="Book Now" :button-url="route('book.now', $unit->slug)" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
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
