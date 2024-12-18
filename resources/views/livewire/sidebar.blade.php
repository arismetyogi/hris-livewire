<div x-data="{ open: false }">
    <!-- Sidebar Mobile Toggle -->
    <div class="sticky lg:hidden z-20  px-4 sm:px-6 md:px-8 dark:bg-gray-800">
        <div class="flex gap-2 items-center py-4 px-2">
            <button type="button" @click="open = true" class="text-gray-500 hover:text-gray-600">
                <span class="sr-only">Toggle Navigation</span>
                <x-heroicon-o-bars-3 class="flex-shrink-0 size-5"/>
            </button>
            <!-- Breadcrumbs -->
            <div class="mobile-breadcrumbs">
                <!-- Mobile breadcrumbs will be teleported here -->
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div :class="{ 'translate-x-0': open }"
         class="transform -translate-x-full lg:translate-x-0 transition-all duration-300 fixed top-0 start-0 bottom-0 z-[60] w-64 bg-white border-e border-gray-200 pt-7 pb-10 overflow-y-auto lg:block lg:end-auto lg:bottom-0 dark:bg-gray-800 dark:border-gray-700 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-slate-700 dark:[&::-webkit-scrollbar-thumb]:bg-slate-500">
        <div class="px-6">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-2 text-xl font-semibold text-primary-500 dark:text-primary-100 ">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                <span>{{ config('app.name') }}</span>
            </a>
        </div>

        <nav class="p-6 w-full flex flex-col flex-wrap">
            <ul>
                <x-sidebar-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                    icon="heroicon-o-home">
                    {{ __('Dashboard') }}
                </x-sidebar-nav-link>
                <x-sidebar-nav-link :href="route('employees')" :active="request()->routeIs('employees')"
                                    icon="heroicon-o-users">
                    {{ __('Employees') }}
                </x-sidebar-nav-link>
                <x-sidebar-nav-link :href="route('payrolls')" :active="request()->routeIs('payrolls')"
                                    icon="heroicon-o-banknotes">
                    {{ __('Payroll') }}
                </x-sidebar-nav-link>
                <x-sidebar-nav-group label="System Settings"
                                     :active="request()->routeIs('departments', 'stores', 'zips')"
                                     icon="heroicon-m-cog">
                    <x-sidebar-nav-link :href="route('departments')" :active="request()->routeIs('departments')"
                                        icon="heroicon-o-academic-cap">
                        Departments
                    </x-sidebar-nav-link>
                    <x-sidebar-nav-link :href="route('stores')" :active="request()->routeIs('stores')"
                                        icon="heroicon-o-building-storefront">
                        Stores
                    </x-sidebar-nav-link>
                    <x-sidebar-nav-link :href="route('zips')" :active="request()->routeIs('zips')"
                                        icon="heroicon-o-map">
                        Zips
                    </x-sidebar-nav-link>
                </x-sidebar-nav-group>
                <x-sidebar-nav-group label="User Settings"
                                     :active="request()->routeIs('users')"
                                     icon="heroicon-m-user-group">
                    <x-sidebar-nav-link :href="route('users')" :active="request()->routeIs('users')"
                                        icon="heroicon-o-user-group">
                        Users
                    </x-sidebar-nav-link>
                    <x-sidebar-nav-link :href="route('profile.show')" :active="request()->routeIs('profile.show')"
                                        icon="heroicon-o-pencil">
                        My Profile
                    </x-sidebar-nav-link>
                </x-sidebar-nav-group>
            </ul>
            <ul>
                <button wire:click="logout" class="w-52 text-start content-center fixed bottom-4">
                    <x-sidebar-nav-link class="flex items-center gap-4 font-semibold text-red-600">
                        <x-heroicon-o-arrow-left-start-on-rectangle class="size-6"/>
                        {{ __('Log Out') }}
                    </x-sidebar-nav-link>
                </button>
            </ul>
        </nav>
    </div>

    <!-- Overlay -->
    <div x-show="open" x-cloak x-transition.opacity @click="open = false"
         class="fixed inset-0 z-[59] bg-gray-900 bg-opacity-50 dark:bg-opacity-80">
    </div>
</div>