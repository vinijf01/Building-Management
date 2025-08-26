<x-app-layout>
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-breadcrumbs :links="[
                ['label' => 'Home', 'url' => route('home')],
                ['label' => 'Products', 'url' => route('products.list')],
                ['label' => $product->slug],
            ]" />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-8 lg:px-8">
                    <div x-data="{
                        open: false,
                        active: 0,
                        images: [
                            'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
                            'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1523413651479-597eb2da0ad6?auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13?auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=800&q=80',
                            'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=800&q=80',
                        ]
                    }" class="max-w-6xl mx-auto px-2">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 w-full">
                            <div class="col-span-2 sm:col-span-2 sm:row-span-2 relative cursor-pointer h-48 sm:h-[400px]"
                                @click="open=true; active=0">
                                <img :src="images[0]" alt="Main"
                                    class="w-full h-full object-cover rounded-lg" />
                            </div>

                            <div class="grid grid-cols-2 gap-2 col-span-2 sm:col-span-1 h-48 sm:h-[400px]">
                                <template x-for="(img, index) in images.slice(1,5)" :key="index">
                                    <div class="relative cursor-pointer h-24 sm:h-[200px]"
                                        @click="open=true; active=index+1">
                                        <img :src="img" class="w-full h-full object-cover rounded-lg" />

                                        <template x-if="index === 3">
                                            <div
                                                class="absolute inset-0 bg-black/50 flex items-center justify-center rounded-lg">
                                                <span class="text-white font-semibold text-sm sm:text-lg">+ Lihat
                                                    semua</span>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div x-show="open" x-transition
                            class="fixed inset-0 bg-black/80 flex items-center justify-center z-50 p-4">
                            <div class="relative w-full max-w-4xl">
                                <button @click="open=false"
                                    class="absolute top-2 right-2 text-white text-3xl font-bold">&times;</button>

                                <div class="flex items-center justify-center">
                                    <img :src="images[active]" class="rounded-lg max-h-[70vh] w-auto mx-auto" />
                                </div>

                                <div class="flex justify-between mt-4 text-white text-sm sm:text-base">
                                    <button @click="active = (active-1+images.length)%images.length"
                                        class="px-3 py-1 sm:px-4 sm:py-2 bg-white/20 rounded">← Prev</button>
                                    <button @click="active = (active+1)%images.length"
                                        class="px-3 py-1 sm:px-4 sm:py-2 bg-white/20 rounded">Next →</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" mt-12 grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2">
                            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900">{{ $product->title }}</h1>
                            <p class="mt-4 text-lg text-gray-700">{{ $product->description }}</p>
                            <div class="mt-6 space-y-2 text-gray-800">
                                <p><span class="font-semibold">Category </span> {{ ucfirst($product->category) }}</p>
                            </div>
                            
                        </div>

                        <div>
                            <div class="bg-gray-50 border border-gray-200 rounded-lg shadow-md p-6 sticky top-20">
                                <p class="text-2xl font-bold text-blue-600 mb-4">Rp.
                                    {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <!-- Kalau user sudah login -->
                                @auth
                                    <a href="{{ route('booking.form', ['slug' => $product->slug]) }}" id="book-now"
                                        @click.prevent="$store.auth.openLogin = true"
                                        class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition duration-200 mb-4">
                                        Book Now
                                    </a>
                                @endauth
                                <!-- Kalau user belum login -->
                                @guest
                                    <button x-data @click="$store.auth.openLogin = true; $store.auth.openRegister = false"
                                        class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition duration-200 mb-4">
                                        Book Now
                                    </button>
                                @endguest
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
            </div>

            <div class="bg-white my-12 overflow-hidden shadow-sm sm:rounded-lg">
                @if ($relatedProducts->count())
                    <div class="mx-auto max-w-screen-xl sm:px-6 sm:py-8 lg:px-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">You Might Also Like</h2>
                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper mb-6">
                                @foreach ($relatedProducts as $unit)
                                    <div class="swiper-slide">
                                        <x-cards :title="$unit->name" :description="$unit->description" :price="$unit->price" :image-url="$unit->cover_image
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
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
