<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ $title ?? config("app.name", "Laravel") }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>

    <body
        class="antialiased text-gray-600 bg-gray-100 font-inter dark:bg-gray-900 dark:text-gray-400"
        :class="{ 'sidebar-expanded': sidebarExpanded }"
        x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
        x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))"
    >

        <x-banner />

        <div class="flex min-h-screen bg-gray-100">
            <livewire:app-sidebar />
            <div
                class="relative flex flex-col flex-1 @if ($attributes['background']) {{
                    $attributes['background']
                }} @endif"
                x-ref="contentarea"
            >
                <livewire:navigation-menu
                    class="sticky top-0 z-50 bg-white shadow"
                />

                <!-- Page Heading -->
                @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        @stack('modals') @livewireScripts
        <script>
            if (localStorage.getItem("sidebar-expanded") == "true") {
                document
                    .querySelector("body")
                    .classList.add("sidebar-expanded");
            } else {
                document
                    .querySelector("body")
                    .classList.remove("sidebar-expanded");
            }
        </script>

    </body>
</html>
