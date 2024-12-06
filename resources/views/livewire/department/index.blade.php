<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __("Departments") }}
            </h2>
        </x-slot>
        <div class="flex flex-wrap items-center justify-between py-12 space-y-4 flex-column md:flex-row md:space-y-0">
            <div class="ml-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.live.debounce.350="search" type="text" id="table-search"
                           class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search for departments"/>
                </div>
            </div>
            <x-button wire:click="$dispatch('openModal', { component: 'department.create-modal' })" class="mb-4">
                add new department
            </x-button>
        </div>

        <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable>No</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('id')"
                                     :direction="$sortField === 'id' ? $sortDirection : null">Department ID
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('name')"
                                     :direction="$sortField === 'name' ? $sortDirection : null">Department Name
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('updated_at')"
                                     :direction="$sortField === 'updated_at' ? $sortDirection : null">Last Update
                    </x-table.heading>
                    <x-table.heading sortable>Action</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($departments as $department)
                        <x-table.row>
                            <x-table.cell>{{ $departments->firstItem() + $loop->index }}</x-table.cell>
                            <x-table.cell class="flex">
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $department->id}}</div>
                                    <div class="font-normal text-xs text-gray-400">{{ $department->name }}</div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>{{ $department->name ? $department->name : null }}</x-table.cell>
                            <x-table.cell>{{ $department->updated_at ? $department->updated_at->diffForHumans() : null }}</x-table.cell>
                            <x-table.cell>
                                <x-button
                                    wire:click="$dispatch('openModal', { component: 'department.create-modal', arguments: { department: {{ $department->id }} }})"
                                    class="mb-4">
                                    edit
                                </x-button>
                                <x-danger-button
                                    wire:click="$dispatch('openModal', { component: 'delete-modal', arguments: {model: 'Department', recordId: {{ $department->id}} }})">
                                    delete
                                </x-danger-button>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">No Department Found!</td>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table>
        </div>

        <div class="flex flex-wrap items-center justify-between py-12 space-y-4 flex-column md:flex-row md:space-y-0">
            <div wire:model.live="perPage">
                <label for="perPage">per Page:</label>
                <select id="perPage" class="border-gray-300 rounded">
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div>
                {{ $departments->links() }}
            </div>
        </div>

    </div>

</div>
