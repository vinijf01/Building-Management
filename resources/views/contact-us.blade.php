<x-app-layout>
    <div class="py-6 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                
                <!-- Left: Google Map -->
                <div class="h-96 md:h-auto">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3163.157732542857!2d-122.08424968469269!3d37.42206597982561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fb0b08b6c90c3%3A0xe2f9e3f3ad0f1e3c!2sGoogleplex!5e0!3m2!1sen!2sid!4v1677225634567!5m2!1sen!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <!-- Right: Contact Info -->
                <div class="p-8 flex flex-col justify-center">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Contact Us</h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">
                        Have questions or want to get in touch? We’d love to hear from you.
                    </p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657L12 21.071l5.657-4.414z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 100-6 3 3 0 000 6z" />
                            </svg>
                            <span class="text-gray-800 dark:text-gray-200">123 Main Street, City, Country</span>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-800 dark:text-gray-200">info@example.com</span>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5h2l3.6 7.59a1 1 0 00.82.41h7.16a1 1 0 00.82-.41L21 5h-2m-5 14h.01M12 19h.01M7 14h.01M17 14h.01" />
                            </svg>
                            <span class="text-gray-800 dark:text-gray-200">+62 812 3456 7890</span>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app-layout>
