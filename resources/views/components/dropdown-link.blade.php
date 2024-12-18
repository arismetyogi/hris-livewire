@props(['icon'])

@php
    $icon = ($icon ?? false);
@endphp

<a {{ $attributes->merge(['class' => 'flex items-center gap-4 w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out']) }}>
    @if($icon)
        @svg($icon, 'flex-shrink-0 size-5 text-primary-500 dark:text-primary-100')
    @endif
    {{ $slot }}
</a>
