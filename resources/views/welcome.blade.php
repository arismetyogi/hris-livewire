<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="bg-gray-50 text-black/50">
            <img
                id="background"
                class="absolute -left-20 top-0 max-w-[877px]"
                src="https://laravel.com/assets/img/welcome/background.svg"
                alt="Laravel background"
            />
            <div
                class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
            >
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="flex items-center gap-2 py-10">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <x-application-logo class="min-h-96 min-w-96" />
                        </div>
                        <div class="flex lg:justify-center lg:col-start-2">
                            @if (Route::has('login'))
                            <nav class="flex justify-end flex-1 -mx-3 text-xl">
                                @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    Dashboard
                                </a>
                                @else
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    Log in
                                </a>

                                @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    Register
                                </a>
                                @endif @endauth
                            </nav>
                            @endif
                        </div>
                    </header>

                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8"><</div>
                    </main>

                    <footer
                        class="py-16 text-sm text-center text-black"
                    ></footer>
                </div>
            </div>
        </div>
    </body>
</html>