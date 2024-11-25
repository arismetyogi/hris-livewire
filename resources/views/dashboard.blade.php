<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Dashboard") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <livewire:greeting />
            </div>
            <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="text-indigo-500">Dashboard</div>
            </div>
            <div class="grid grid-cols-3 gap-x-8 gap-y-4 px-8 py-8 justify-between items-center content-center bg-white shadow-xl sm:rounded-lg">
                <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
                <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
                <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
                <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
                <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
                <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
            </div>
        </div>
    </div>
</x-app-layout>
