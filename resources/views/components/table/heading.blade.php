@props(['sortable' => null, 'direction'=>null])

<th
    {{ $attributes->merge(['class' => 'px-6 py-3 bg-gray-50'])->only('class') }}
>
    @unless($sortable)
        <span
            class="text-left text-sm leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ $slot }}</span>
    @else
        <button
            {{ $attributes->except('class') }} class="flex group items-center space-x-1 text-left text-sm leading-4 font-medium">
            <span>{{ $slot }}</span>

            <span>
                @if($direction === 'asc')
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m5 15 7-7 7 7"/>
                    </svg>
                @elseif($direction === 'desc')
                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 9-7 7-7-7"/>
                    </svg>
                @else
                    <svg
                        class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 w-4 h-4 text-gray-800 dark:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                               d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                     </svg>

                @endif
            </span>
        </button>
    @endif
</th>
