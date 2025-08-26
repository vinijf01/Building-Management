<x-app-layout>
    <div class="py-4 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :links="[['label' => 'Home', 'url' => route('home')], ['label' => 'FAQ']]" />

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">

                <!-- Left: FAQ Title -->
                <div class="p-10 flex flex-col justify-center">
                    <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-6">
                        Frequently Asked Questions
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        Find answers to the most common questions about <span class="font-semibold">booking</span> and
                        <span class="font-semibold">rooms</span>.
                        If you can’t find what you’re looking for, our team is here to help.
                    </p>
                    <a href="{{ route('contact-us') }}"
                        class="inline-block text-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow-md transition">
                        Contact Our Team
                    </a>
                </div>

                <!-- Right: FAQ Accordion -->
                <div class="p-8" x-data="{ open: null }">
                    <div class="space-y-6">

                        <!-- Item 1 -->
                        <div class="border rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                            <button @click="open === 1 ? open = null : open = 1"
                                class="w-full flex justify-between items-center p-4 text-left">
                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    How do I make a booking?
                                </span>
                                <svg :class="{ 'rotate-180': open === 1 }"
                                    class="w-5 h-5 text-gray-500 transform transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open === 1" x-collapse class="px-4 pb-4 text-gray-600 dark:text-gray-300">
                                You can book directly through our website by selecting your preferred dates and room
                                type.
                                Once confirmed, you’ll receive an email with your booking details.
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="border rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                            <button @click="open === 2 ? open = null : open = 2"
                                class="w-full flex justify-between items-center p-4 text-left">
                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    Can I modify or cancel my booking?
                                </span>
                                <svg :class="{ 'rotate-180': open === 2 }"
                                    class="w-5 h-5 text-gray-500 transform transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open === 2" x-collapse class="px-4 pb-4 text-gray-600 dark:text-gray-300">
                                Yes, you can modify or cancel your booking up to 48 hours before your check-in date
                                without any extra charges. Simply log in to your account or contact our support team.
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="border rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                            <button @click="open === 3 ? open = null : open = 3"
                                class="w-full flex justify-between items-center p-4 text-left">
                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    What room types are available?
                                </span>
                                <svg :class="{ 'rotate-180': open === 3 }"
                                    class="w-5 h-5 text-gray-500 transform transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open === 3" x-collapse class="px-4 pb-4 text-gray-600 dark:text-gray-300">
                                We offer a variety of room options including Standard, Deluxe, and Suite. Each room is
                                fully
                                furnished with modern amenities to ensure comfort and convenience.
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="border rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                            <button @click="open === 4 ? open = null : open = 4"
                                class="w-full flex justify-between items-center p-4 text-left">
                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    Is breakfast included in the booking?
                                </span>
                                <svg :class="{ 'rotate-180': open === 4 }"
                                    class="w-5 h-5 text-gray-500 transform transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open === 4" x-collapse class="px-4 pb-4 text-gray-600 dark:text-gray-300">
                                Yes, complimentary breakfast is included in most of our room packages.
                                You can also request special dietary options when booking.
                            </div>
                        </div>

                        <!-- Item 5 -->
                        <div class="border rounded-lg overflow-hidden bg-white dark:bg-gray-800">
                            <button @click="open === 5 ? open = null : open = 5"
                                class="w-full flex justify-between items-center p-4 text-left">
                                <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    Do you offer group or long-term booking discounts?
                                </span>
                                <svg :class="{ 'rotate-180': open === 5 }"
                                    class="w-5 h-5 text-gray-500 transform transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open === 5" x-collapse class="px-4 pb-4 text-gray-600 dark:text-gray-300">
                                Absolutely! We provide special rates for group bookings, corporate stays, and long-term
                                reservations. Please contact our sales team for a tailored package.
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

        <section class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            <x-search-section title="Find your dream home" placeholder="Search houses, apartments..." button="Go!"
                :action="route('products.list')" />
        </section>
    </div>
</x-app-layout>
