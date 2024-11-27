<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __("Dashboard") }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="mx-auto space-y-3 max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <livewire:greeting/>
                </div>
                <div class="p-4 overflow-hidden space-y-4 bg-white shadow-xl sm:rounded-lg">
                    <div class="text-indigo-500">Dashboard</div>
                    <div
                        class="grid grid-cols-3 gap-x-8 gap-y-4 px-8 py-8 justify-between items-center content-center bg-white shadow-xl sm:rounded-lg">
                        <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
                        <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
                        <div class="text-primary-700 px-8 py-4 bg-gray-50 shadow-lg h-64">Card</div>
                    </div>
                    <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                        <div class="text-secondary-500 font-semibold text-xl my-4 py-4 px-8">Departments</div>
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading sortable>No</x-table.heading>
                                <x-table.heading sortable>Department ID</x-table.heading>
                                <x-table.heading sortable>Department Name</x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @forelse(\App\Models\Department::latest()->take(5)->get() as $department)
                                    <x-table.row>
                                        <x-table.cell>{{ $loop->iteration }}</x-table.cell>
                                        <x-table.cell>
                                            <div class="ps-3">
                                                <div class="text-base font-semibold">{{ $department->id}}</div>
                                                <div
                                                    class="font-normal text-xs text-gray-400">{{ $department->name }}</div>
                                            </div>
                                        </x-table.cell>
                                        <x-table.cell>{{ $department->name }}</x-table.cell>
                                    </x-table.row>
                                @empty
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">No Department Found!</td>
                                    </tr>
                                @endforelse
                            </x-slot>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
