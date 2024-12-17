<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ $title ?? config("app.name", "Laravel") }}</title>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased text-gray-600 bg-gray-100 font-inter dark:bg-gray-900 dark:text-gray-400">

<x-banner/>

<div class="flex min-h-screen bg-gray-100 relative flex-col flex-1">
    <div class="header">
        <!-- The Header will be teleported here -->
    </div>
    @livewire('sidebar')
    <!-- Page Content -->
    <main class=" pl-0 lg:pl-64
    ">
        {{ $slot }}
    </main>
</div>
<x-notification/>

@stack('modals')
@livewireScriptConfig
@livewire('wire-elements-modal')

</body>

</html>
