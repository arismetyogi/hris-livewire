<div class="sticky top-0 h-full overflow-y-auto min-w-fit">
    <!-- Sidebar backdrop (mobile only) -->
    <div class="fixed inset-0 z-40 transition-opacity duration-200 bg-gray-900 bg-opacity-30 lg:hidden lg:z-auto"
         :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

    <!-- Sidebar -->
    <div id="sidebar"
         class="flex lg:!flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-[100dvh] overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-[80px] lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-white dark:bg-gray-800 p-4 transition-all duration-200 ease-in-out border-r border-gray-200 dark:border-gray-700/60"
         :class="sidebarOpen ? 'max-lg:translate-x-0' : 'max-lg:-translate-x-64'" @click.outside="sidebarOpen = false"
         @keydown.escape.window="sidebarOpen = false">
        <!-- Sidebar header -->
        <div class="flex justify-between pr-3 mb-10 sm:px-2">
            <!-- Close button -->
            <button class="text-gray-500 lg:hidden hover:text-gray-400" @click.stop="sidebarOpen = !sidebarOpen"
                    aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z"/>
                </svg>
            </button>
            <!-- Logo -->
            <a wire:navigate class="block" href="{{ route('dashboard') }}">
                <x-application-logo class="lg:w-[40px] xl:w-40"/>
            </a>
        </div>

        <!-- Links -->
        <div class="space-y-8">
            <!-- Pages group -->
            <div>
                <h3 class="pl-3 text-xs font-semibold text-gray-400 uppercase dark:text-gray-500">
                    <span class="hidden w-6 text-center lg:block lg:sidebar-expanded:hidden 2xl:hidden"
                          aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Pages</span>
                </h3>
                <ul class="mt-3">
                    <!-- Dashboard -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['dashboard'])) {{
                            'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]'
                        }} @endif">
                        <a wire:navigate class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['dashboard'])) {{
                                'hover:text-gray-900 dark:hover:text-white'
                            }} @endif" href="{{ route('dashboard') }}">
                            <div class="flex items-center">
                                <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['dashboard'])) {{
                                        'text-violet-500'
                                    }}@else{{
                                        'text-gray-400 dark:text-gray-500'
                                    }} @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     viewBox="0 0 16 16">
                                    <path
                                        d="M5.936.278A7.983 7.983 0 0 1 8 0a8 8 0 1 1-8 8c0-.722.104-1.413.278-2.064a1 1 0 1 1 1.932.516A5.99 5.99 0 0 0 2 8a6 6 0 1 0 6-6c-.53 0-1.045.076-1.548.21A1 1 0 1 1 5.936.278Z"/>
                                    <path
                                        d="M6.068 7.482A2.003 2.003 0 0 0 8 10a2 2 0 1 0-.518-3.932L3.707 2.293a1 1 0 0 0-1.414 1.414l3.775 3.775Z"/>
                                </svg>
                                <span
                                    class="ml-4 text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <!-- Employees -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['employees'])) {{
                            'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]'
                        }} @endif" x-data="{ open: {{ in_array(Request::segment(1), ['employees']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['employees'])) {{
                                'hover:text-gray-900 dark:hover:text-white'
                            }} @endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['employees'])) {{
                                            'text-violet-500'
                                        }}@else{{
                                            'text-gray-400 dark:text-gray-500'
                                        }} @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 16 16">
                                        <path
                                            d="M9 6.855A3.502 3.502 0 0 0 8 0a3.5 3.5 0 0 0-1 6.855v1.656L5.534 9.65a3.5 3.5 0 1 0 1.229 1.578L8 10.267l1.238.962a3.5 3.5 0 1 0 1.229-1.578L9 8.511V6.855ZM6.5 3.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm4.803 8.095c.005-.005.01-.01.013-.016l.012-.016a1.5 1.5 0 1 1-.025.032ZM3.5 11c.474 0 .897.22 1.171.563l.013.016.013.017A1.5 1.5 0 1 1 3.5 11Z"/>
                                    </svg>
                                    <span
                                        class="ml-4 text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Employees
                                        Data</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex ml-2 duration-200 shrink-0 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['dashboard'])) {{
                                            'rotate-180'
                                        }} @endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['employees'])) {{
                                    'hidden'
                                }} @endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a wire:navigate class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('employees')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('employees') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Employees</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a wire:navigate class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('payrolls')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('payrolls') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Payrolls</span>
                                    </a>
                                </li>
                                {{--
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('invoices')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('invoices') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Invoices</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('shop')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('shop') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Shop</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('shop-2')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('shop-2') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Shop
                                            2</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('product')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('product') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Single
                                            Product</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cart')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('cart') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Cart</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cart-2')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('cart-2') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Cart
                                            2</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('cart-3')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('cart-3') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Cart
                                            3</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('pay')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('pay') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Pay</span>
                                    </a>
                                </li>
                                --}}
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- More group -->
            <div>
                <h3 class="pl-3 text-xs font-semibold text-gray-400 uppercase dark:text-gray-500">
                    <span class="hidden w-6 text-center lg:block lg:sidebar-expanded:hidden 2xl:hidden"
                          aria-hidden="true">•••</span>
                    <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Configs</span>
                </h3>
                <ul class="mt-3">
                    <!-- System Config -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] @if (in_array(Request::segment(1), ['settings'])) {{
                            'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]'
                        }} @endif" x-data="{ open: {{ in_array(Request::segment(1), ['settings']) ? 1 : 0 }} }">
                        <a class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['settings'])) {{
                                'hover:text-gray-900 dark:hover:text-white'
                            }} @endif" href="#0" @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="shrink-0 fill-current @if (in_array(Request::segment(1), ['settings'])) {{
                                            'text-violet-500'
                                        }}@else{{
                                            'text-gray-400 dark:text-gray-500'
                                        }} @endif" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                         viewBox="0 0 16 16">
                                        <path
                                            d="M10.5 1a3.502 3.502 0 0 1 3.355 2.5H15a1 1 0 1 1 0 2h-1.145a3.502 3.502 0 0 1-6.71 0H1a1 1 0 0 1 0-2h6.145A3.502 3.502 0 0 1 10.5 1ZM9 4.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM5.5 9a3.502 3.502 0 0 1 3.355 2.5H15a1 1 0 1 1 0 2H8.855a3.502 3.502 0 0 1-6.71 0H1a1 1 0 1 1 0-2h1.145A3.502 3.502 0 0 1 5.5 9ZM4 12.5a1.5 1.5 0 1 0 3 0 1.5 1.5 0 0 0-3 0Z"
                                            fill-rule="evenodd"/>
                                    </svg>
                                    <span
                                        class="ml-4 text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">System
                                        Config</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex ml-2 duration-200 shrink-0 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">
                                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-gray-400 dark:text-gray-500 @if (in_array(Request::segment(1), ['settings'])) {{
                                            'rotate-180'
                                        }} @endif" :class="open ? 'rotate-180' : 'rotate-0'" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1 @if (!in_array(Request::segment(1), ['settings'])) {{
                                    'hidden'
                                }} @endif" :class="open ? '!block' : 'hidden'">
                                <li class="mb-1 last:mb-0">
                                    <a wire:navigate class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('dashboard')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('zips') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Zip</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a wire:navigate class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('dashboard')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('departments') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Department</span>
                                    </a>
                                </li>
                                <li class="mb-1 last:mb-0">
                                    <a wire:navigate class="block text-gray-500/90 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition truncate @if (Route::is('stores')) {{
                                            '!text-violet-500'
                                        }} @endif" href="{{ route('stores') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Outlet</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- User Config -->
                    <li class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0" x-data="{ open: false }">
                        <a class="block text-gray-800 truncate transition dark:text-gray-100"
                           :class="open ? '' : 'hover:text-gray-900 dark:hover:text-white'" href="#0"
                           @click.prevent="open = !open; sidebarExpanded = true">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="size-6 shrink-0 fill-current @if (in_array(Request::segment(1), ['dashboard'])) {{
                                            'text-violet-500'
                                        }}@else{{
                                            'text-gray-400 dark:text-gray-500'
                                        }} @endif" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                    </svg>
                                    <span
                                        class="ml-4 text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">User
                                        Config</span>
                                </div>
                                <!-- Icon -->
                                <div
                                    class="flex ml-2 duration-200 shrink-0 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">
                                    <svg class="w-3 h-3 ml-1 text-gray-400 fill-current shrink-0 dark:text-gray-500"
                                         :class="{ 'rotate-180': open }" viewBox="0 0 12 12">
                                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        <div class="lg:hidden lg:sidebar-expanded:block 2xl:block">
                            <ul class="pl-8 mt-1" :class="{ 'hidden': !open }" x-cloak>
                                <li class="mb-1 last:mb-0">
                                    <a wire:navigate class="block text-gray-800 dark:text-gray-100 truncate transition @if (!in_array(Request::segment(1), ['users'])) {{
                                            'hover:text-gray-900 dark:hover:text-white'
                                        }} @endif" href="{{ route('users') }}">
                                        <span
                                            class="text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Users</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li
                        class="absolute bottom-24 pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))] from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]">
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a class="block text-gray-800 truncate transition dark:text-gray-100 hover:text-gray-900 dark:hover:text-white"
                               href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                <div class="flex items-center">
                                    <svg class="text-gray-400 shrink-0 dark:text-gray-500" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                         viewBox="0 0 24 24">
                                        <path d="M14 19V5h4a1 1 0 0 1 1 1v11h1a1 1 0 0 1 0 2h-6Z"/>
                                        <path fill-rule="evenodd"
                                              d="M12 4.571a1 1 0 0 0-1.275-.961l-5 1.428A1 1 0 0 0 5 6v11H4a1 1 0 0 0 0 2h1.86l4.865 1.39A1 1 0 0 0 12 19.43V4.57ZM10 11a1 1 0 0 1 1 1v.5a1 1 0 0 1-2 0V12a1 1 0 0 1 1-1Z"
                                              clip-rule="evenodd"/>
                                    </svg>

                                    <span
                                        class="ml-4 text-sm font-medium duration-200 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100">Log
                                        Out</span>
                                </div>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Expand / collapse button -->
        <div class="justify-end hidden pt-3 mt-auto lg:inline-flex 2xl:hidden">
            <div class="w-12 py-2 pl-4 pr-3">
                <button
                    class="text-gray-400 transition-colors hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400"
                    @click="sidebarExpanded = !sidebarExpanded">
                    <span class="sr-only">Expand / collapse sidebar</span>
                    <svg class="text-gray-400 fill-current shrink-0 dark:text-gray-500 sidebar-expanded:rotate-180"
                         xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                        <path
                            d="M15 16a1 1 0 0 1-1-1V1a1 1 0 1 1 2 0v14a1 1 0 0 1-1 1ZM8.586 7H1a1 1 0 1 0 0 2h7.586l-2.793 2.793a1 1 0 1 0 1.414 1.414l4.5-4.5A.997.997 0 0 0 12 8.01M11.924 7.617a.997.997 0 0 0-.217-.324l-4.5-4.5a1 1 0 0 0-1.414 1.414L8.586 7M12 7.99a.996.996 0 0 0-.076-.373Z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
