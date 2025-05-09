@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center text-sm font-medium text-[#1a73e8] dark:text-[#8ab4f8] hover:text-[#1557b0] dark:hover:text-[#aecbfa] focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center text-sm font-medium text-[#5f6368] dark:text-[#9aa0a6] hover:text-[#202124] dark:hover:text-[#e8eaed] focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> 