<div class="pb-4 flex items-center flex-wrap rounded-lg shadow-sm">
    <ul class="flex items-center">
        @foreach ($links as $index => $link)
            <li class="inline-flex items-center">
                {{-- Icon Home untuk item pertama --}}
                @if ($index === 0)
                    <a href="{{ $link['url'] ?? '#' }}" class="text-gray-600 hover:text-blue-500">
                        <svg class="w-5 h-auto fill-current mx-2 text-gray-400"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0V0z" fill="none"/>
                            <path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 
                                1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 
                                3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 
                                .55.45 1 1 1h3c.55 0 1-.45 1-1z"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ $link['url'] ?? '#' }}"
                       class="text-gray-600 hover:text-blue-500 {{ $loop->last ? 'text-blue-500' : '' }}">
                        {{ $link['label'] }}
                    </a>
                @endif

                {{-- Panah kecuali di item terakhir --}}
                @if (!$loop->last)
                    <svg class="w-5 h-auto fill-current mx-2 text-gray-400"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 
                            4.59L10 18l6-6-6-6z"/>
                    </svg>
                @endif
            </li>
        @endforeach
    </ul>
</div>
