<div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden flex flex-col h-full">
    <img src="{{ $imageUrl }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    <div class="p-4 flex-1 flex flex-col">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $title }}</h3>
        <p class="text-gray-600 dark:text-gray-400 text-sm mb-2"> {{ Str::limit($description, 32, '...') }}</p>
        <div class="flex justify-between items-center text-sm text-gray-700 dark:text-gray-300 mb-3">
            <span>Rp. {{ number_format($price, 0, ',', '.') }} / day</span>
        </div>

        {{-- Ubah button jadi link --}}
        <a href="{{ $buttonUrl ?? '#' }}"
            class="mt-auto block text-center w-full bg-blue-500 text-white rounded-md py-2 hover:bg-blue-600 transition">
            {{ $buttonText }}
        </a>

    </div>
</div>
