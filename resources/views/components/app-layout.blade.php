<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => { if (val) { document.documentElement.classList.add('dark'); } else { document.documentElement.classList.remove('dark'); } })">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Stacker') }}</title>

        <!-- Initialize Dark Mode -->
        <script>
            // Immediately set dark mode if it was previously enabled
            if (localStorage.getItem('darkMode') === 'true') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            :root {
                --primary-color: #1a73e8;
                --primary-hover: #1557b0;
                --text-primary: #202124;
                --text-secondary: #5f6368;
                --background: #f8f9fa;
                --surface: #ffffff;
                --border: #dadce0;
            }

            .dark {
                --primary-color: #8ab4f8;
                --primary-hover: #aecbfa;
                --text-primary: #e8eaed;
                --text-secondary: #9aa0a6;
                --background: #202124;
                --surface: #2d2e31;
                --border: #3c4043;
            }
            
            body {
                font-family: 'Roboto', sans-serif;
                color: var(--text-primary);
                background-color: var(--background);
            }

            .btn-primary {
                background-color: var(--primary-color);
                color: var(--surface);
                padding: 8px 24px;
                border-radius: 4px;
                font-weight: 500;
                transition: background-color 0.2s;
            }

            .btn-primary:hover {
                background-color: var(--primary-hover);
            }

            .card {
                background: var(--surface);
                border-radius: 8px;
                box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15);
                transition: box-shadow 0.2s;
                color: var(--text-primary);
            }

            .card:hover {
                box-shadow: 0 1px 3px 0 rgba(60,64,67,0.3), 0 4px 8px 3px rgba(60,64,67,0.15);
            }

            .dark .card {
                box-shadow: 0 1px 2px 0 rgba(0,0,0,0.3), 0 1px 3px 1px rgba(0,0,0,0.15);
            }

            .dark .card:hover {
                box-shadow: 0 1px 3px 0 rgba(0,0,0,0.3), 0 4px 8px 3px rgba(0,0,0,0.15);
            }

            /* Table Styles */
            .table-container {
                background: var(--surface);
                border-radius: 8px;
                overflow: hidden;
            }

            .table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
            }

            .table thead {
                background: var(--background);
            }

            .table th {
                color: var(--text-secondary);
                font-weight: 500;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.05em;
                padding: 0.75rem 1rem;
                text-align: left;
            }

            .table tbody tr {
                border-bottom: 1px solid var(--border);
            }

            .table tbody tr:last-child {
                border-bottom: none;
            }

            .table td {
                color: var(--text-primary);
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }

            .table tbody tr:hover {
                background: var(--background);
            }

            /* Status Badge Styles */
            .status-badge {
                padding: 0.25rem 0.5rem;
                border-radius: 9999px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: capitalize;
            }

            .status-badge.completed {
                background-color: rgba(34, 197, 94, 0.1);
                color: rgb(34, 197, 94);
            }

            .status-badge.cancelled {
                background-color: rgba(239, 68, 68, 0.1);
                color: rgb(239, 68, 68);
            }

            .status-badge.pending {
                background-color: rgba(234, 179, 8, 0.1);
                color: rgb(234, 179, 8);
            }

            .dark .status-badge.completed {
                background-color: rgba(34, 197, 94, 0.2);
                color: rgb(74, 222, 128);
            }

            .dark .status-badge.cancelled {
                background-color: rgba(239, 68, 68, 0.2);
                color: rgb(248, 113, 113);
            }

            .dark .status-badge.pending {
                background-color: rgba(234, 179, 8, 0.2);
                color: rgb(250, 204, 21);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-[#2d2e31] shadow-sm">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-[#202124] dark:text-[#e8eaed]">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        @stack('scripts')
    </body>
</html> 