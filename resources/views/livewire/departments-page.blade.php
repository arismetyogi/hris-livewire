<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __("Departments") }}
            </h2>
        </x-slot>
        <div class="flex flex-wrap items-center justify-between py-12 space-y-4 flex-column md:flex-row md:space-y-0">
            <div class="ml-4">
                <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                        class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">
                    <span class="sr-only">Action button</span>
                    Action
                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownAction"
                     class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                        <li>
                            <a href="#"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export
                                Data</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="#"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                            Selected</a>
                    </div>
                </div>

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
            <x-button wire:click="$dispatch('openModal', { component: 'department-modal' })" class="mb-4">
                add new department
            </x-button>
        </div>

        <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="text-secondary-500 font-semibold text-xl my-4 py-4 px-8">Departments</div>
            <x-table>
                <x-slot name="head">
                    <x-table.heading></x-table.heading>
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
                            <x-table.cell>
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                                    <label for="checkbox-all-search" class="sr-only">check</label>
                                </div>
                            </x-table.cell>
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
                                    wire:click="$dispatch('openModal', { component: 'department-modal', arguments: { department: {{ $department->id }} }})"
                                    class="mb-4">
                                    edit
                                </x-button>
                                <x-danger-button wire:click='confirmDepartmentDeletion({{ $department->id }})'>
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
        <!-- Delete User Modal -->
        <x-dialog-modal wire:model.live="confirmingDepartmentDeletion">
            <x-slot name="title">
                {{ __('Delete Department') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to permanently delete this department?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="set('confirmingDepartmentDeletion', false)"
                                    wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteDepartment({{ $confirmingDepartmentDeletion }})"
                                 wire:loading.attr="disabled">
                    {{ __('Delete Department') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>

        <!-- Edit User Modal -->
        <x-dialog-modal id="editDepartmentModal" wire:model.live="editDepartmentModal" submit="edit">
            <x-slot name="title">
                {{ __('Edit Department Details') }}
            </x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-12 gap-4 sm:grid-cols-8">
                    <!-- ID -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="form.id" value="{{ __('Department ID') }}"/>
                        <x-input id="form.id" type="text" class="block w-full mt-1" wire:model="form.id"
                                 required autocomplete="department.id"/>
                        <x-input-error for="form.id" class="mt-2"/>
                    </div>

                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="form.name" value="{{ __('Department Name') }}"/>
                        <x-input id="form.name" type="text" class="block w-full mt-1" wire:model="form.name"
                                 autocomplete="department.name"/>
                        <x-input-error for="form.name" class="mt-2"/>
                    </div>

                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="set('editDepartmentModal', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-button class="ms-3" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
