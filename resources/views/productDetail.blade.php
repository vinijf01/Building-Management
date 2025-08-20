<x-app-layout>
    <div class="pb-12 pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcrumbs :links="[
                ['label' => 'Home', 'url' => route('dashboard')],
                ['label' => 'Products', 'url' => route('products.list')],
                ['label' => $product->title, 'url' => ''],
            ]" />

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-6 sm:p-8 lg:p-10">
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $product->cover_image) }}" alt="{{ $product->title }}"
                        class="w-full h-[400px] object-cover rounded-xl shadow">
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ $product->title }}</h1>
                        <p class="mt-4 text-lg text-gray-700">{{ $product->description }}</p>
                        <div class="mt-6 space-y-2 text-gray-800">
                            <p><span class="font-semibold">Room Type:</span> {{ ucfirst($product->room_type) }}</p>
                        </div>
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-900">Additional Information</h2>
                            <p class="mt-3 text-gray-600 leading-relaxed">
                                {{ $product->additional_info ?? 'No additional info available.' }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-md p-6 sticky top-20">
                            <p class="text-2xl font-bold text-blue-600 mb-4">${{ number_format($product->price, 2) }}
                            </p>
                            <a href="#"
                                class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition duration-200 mb-4">
                                Book Now
                            </a>
                            {{-- <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow transition duration-200">
                                Consult with Us
                            </button> --}}
                            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20konsultasi"
                                target="_blank"
                                class="w-full block text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow transition duration-200">
                                Consult with Us
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            @if ($relatedProducts->count())
                <div class="bg-white my-12 rounded-2xl shadow-lg overflow-hidden px-6 sm:p-8 lg:p-10">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">You Might Also Like</h2>
                    <div class="swiper mySwiper">
                    <div class="swiper-wrapper mb-12">
                        @foreach ($relatedProducts as $unit)
                            <div class="swiper-slide">
                                <x-cards :title="$unit->title" :description="$unit->description" :price="$unit->price" :image-url="$property->cover_image
                                            ? asset('storage/' . $property->cover_image)
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
            @endif
        </div>
    </div>
</x-app-layout>
