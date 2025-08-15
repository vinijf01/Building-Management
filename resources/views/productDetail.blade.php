{{-- <x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="lg:flex lg:gap-8">
                        <!-- Product Image -->
                        <div class="lg:w-1/2">
                            <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="w-full h-auto rounded-lg shadow-md">
                        </div>

                        <!-- Product Info -->
                        <div class="lg:w-1/2 mt-6 lg:mt-0">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->title }}</h1>
                            <p class="text-gray-600 mt-4">{{ $product->description }}</p>

                            <div class="mt-6 flex flex-col gap-2 text-gray-800">
                                <span><strong>Room Type:</strong> {{ ucfirst($product->room_type) }}</span>
                                <span><strong>Bedrooms:</strong> {{ $product->bedrooms }}</span>
                                <span class="text-blue-600 font-bold text-xl">${{ $product->price }}</span>
                            </div>

                            <button class="mt-6 w-full lg:w-auto bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                                Book Now
                            </button>
                        </div>
                    </div>

                    <!-- Additional Info / Tabs (Optional) -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-900">Additional Information</h2>
                        <p class="mt-2 text-gray-600">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at dolor vel velit fermentum luctus.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <div class="pb-12 pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcrumbs :links="[
                ['label' => 'Home', 'url' => route('dashboard')],
                ['label' => 'Products', 'url' => route('products.list')],
                ['label' => $product->title, 'url' => ''], // terakhir = active
            ]" />

            <!-- Kontainer Putih Rounded -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-6 sm:p-8 lg:p-10">

                <!-- Gambar di Atas dengan Padding -->
                <div class="mb-8">
                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}"
                        class="w-full h-[400px] object-cover rounded-xl shadow">
                </div>

                <!-- Konten -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Kiri: Info Produk -->
                    <div class="lg:col-span-2">
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ $product->title }}</h1>
                        <p class="mt-4 text-lg text-gray-700">{{ $product->description }}</p>

                        <div class="mt-6 space-y-2 text-gray-800">
                            <p><span class="font-semibold">Room Type:</span> {{ ucfirst($product->room_type) }}</p>
                            <p><span class="font-semibold">Bedrooms:</span> {{ $product->bedrooms }}</p>
                        </div>

                        <!-- Additional Info -->
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-900">Additional Information</h2>
                            <p class="mt-3 text-gray-600 leading-relaxed">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Quisque at dolor vel velit fermentum luctus.
                                Integer malesuada quam id orci malesuada, vitae porta turpis tempus.
                            </p>
                        </div>
                    </div>

                    <!-- Kanan: Price Card -->
                    <div>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-md p-6 sticky top-20">
                            <p class="text-2xl font-bold text-blue-600 mb-4">${{ number_format($product->price, 2) }}
                            </p>
                            <button
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition duration-200 mb-4">
                                Book Now
                            </button>
                            <button
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow transition duration-200">
                                Consult with Us
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white my-12 rounded-2xl shadow-lg overflow-hidden px-6 sm:p-8 lg:p-10">
                @php
                    $datas = collect([
                        (object) [
                            'title' => 'Modern City Apartment',
                            'description' => 'Spacious and modern 2-bedroom apartment in the city center.',
                            'bedrooms' => 2,
                            'price' => 1200,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Cozy Studio Apartment',
                            'description' => 'Perfect for singles or couples, close to public transport.',
                            'bedrooms' => 1,
                            'price' => 800,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1560448075-bb4caa6d7732?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Luxury Downtown Loft',
                            'description' => 'High ceilings and great city views with 3 bedrooms.',
                            'bedrooms' => 3,
                            'price' => 2500,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Minimalist Apartment',
                            'description' => 'Clean design with bright lighting and open space.',
                            'bedrooms' => 2,
                            'price' => 1000,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Penthouse Suite',
                            'description' => 'Breathtaking city skyline views from the rooftop.',
                            'bedrooms' => 4,
                            'price' => 5000,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Riverside Apartment',
                            'description' => 'Relax with the sound of water right outside your window.',
                            'bedrooms' => 2,
                            'price' => 1500,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1505691723518-36a5ac3be353?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Suburban Comfort',
                            'description' => 'Spacious apartment in a peaceful residential area.',
                            'bedrooms' => 3,
                            'price' => 1100,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1599420186946-7b6a8e0c1b4c?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Vintage Charm Apartment',
                            'description' => 'Retro style with modern amenities.',
                            'bedrooms' => 2,
                            'price' => 900,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1599420186946-7b6a8e0c1b4c?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Student Budget Apartment',
                            'description' => 'Affordable housing option for university students.',
                            'bedrooms' => 1,
                            'price' => 600,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1599420186946-7b6a8e0c1b4c?auto=format&fit=crop&w=600&q=80',
                        ],
                        (object) [
                            'title' => 'Eco-Friendly Apartment',
                            'description' => 'Built with sustainable materials and solar panels.',
                            'bedrooms' => 2,
                            'price' => 1300,
                            'image_url' =>
                                'https://images.unsplash.com/photo-1599420186946-7b6a8e0c1b4c?auto=format&fit=crop&w=600&q=80',
                        ],
                    ]);
                @endphp
                    <div class="">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Lorem Ipsum Best Deals for You ✈️
                        </h2>
                    </div>
                    <div class="">
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper ">
                                @foreach ($datas as $apartment)
                                    <div
                                        class="swiper-slide mt-6 mb-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                        <x-cards :title="$apartment->title" :description="$apartment->description" :bedrooms="$apartment->bedrooms"
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
</x-app-layout>
