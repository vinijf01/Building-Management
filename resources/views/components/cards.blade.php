<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
    <img src="{{ $imageUrl }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $title }}</h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm mb-2">{{ $description }}</p>
        <div class="flex justify-between items-center text-sm text-gray-700 dark:text-gray-300 mb-3">
            <span>Rp. {{ number_format($price, 0, ',', '.') }} / month</span>
        </div>

        {{-- Ubah button jadi link --}}
        <a href="{{ $buttonUrl ?? '#' }}" 
           class="block text-center w-full bg-blue-500 text-white rounded-md py-2 hover:bg-blue-600 transition">
           {{ $buttonText }}
        </a>
    </div>
</div>
