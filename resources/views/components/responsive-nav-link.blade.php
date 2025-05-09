@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 text-left text-base font-medium text-[#1a73e8] dark:text-[#8ab4f8] bg-[#e8f0fe] dark:bg-[#1a73e8]/10 focus:outline-none focus:bg-[#e8f0fe] dark:focus:bg-[#1a73e8]/10 transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 text-left text-base font-medium text-[#5f6368] dark:text-[#9aa0a6] hover:text-[#202124] dark:hover:text-[#e8eaed] hover:bg-[#f8f9fa] dark:hover:bg-[#2d2e31] focus:outline-none focus:bg-[#f8f9fa] dark:focus:bg-[#2d2e31] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> 