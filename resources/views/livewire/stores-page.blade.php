<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __("Stores") }}
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
                            User</a>
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
                           placeholder="Search for users"/>
                </div>
            </div>
            <x-button wire:click="$dispatch('openModal', { component: 'StoreModal' })" class="mb-4">
                Add New Store
            </x-button>
        </div>

        <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <x-table>
                <x-slot name="head">
                    <x-table.heading></x-table.heading>
                    {{--                    <x-table.heading sortable>No</x-table.heading>--}}
                    <x-table.heading sortable wire:click="sortBy('departments.name')"
                                     :direction="$sortField === 'departments.name' ? $sortDirection : null">Department
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('stores.outlet_sap_id')"
                                     :direction="$sortField === 'stores.outlet_sap_id' ? $sortDirection : null">ID SAP
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('stores.name')"
                                     :direction="$sortField === 'stores.name' ? $sortDirection : null">Name
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('stores.store_type')"
                                     :direction="$sortField === 'stores.store_type' ? $sortDirection : null">Store Type
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('stores.operational_date')"
                                     :direction="$sortField === 'stores.operational_date' ? $sortDirection : null">
                        Operational On
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('stores.address')"
                                     :direction="$sortField === 'stores.address' ? $sortDirection : null">
                        Address
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('stores.updated_at')"
                                     :direction="$sortField === 'stores.updated_at' ? $sortDirection : null">Last Update
                    </x-table.heading>
                    <x-table.heading sortable>Action</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($stores as $store)
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                                    <label for="checkbox-all-search" class="sr-only">check</label>
                                </div>
                            </x-table.cell>
                            {{--                            <x-table.cell>{{ $stores->firstItem() + $loop->index }}</x-table.cell>--}}
                            <x-table.cell>{{ $store->department_name }}</x-table.cell>
                            <x-table.cell>{{ $store->outlet_sap_id }}</x-table.cell>
                            <x-table.cell class="flex">
                                <div class="ps-3">
                                    <div
                                        class="text-base font-semibold">{{ $store->name }}</div>
                                    <div class="font-normal text-gray-500">
                                        Phone: {{ $store->phone }}
                                    </div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>{{ $store->store_type }}</x-table.cell>
                            <x-table.cell>{{ \Carbon\Carbon::parse($store->operational_date)->format('Y') }}</x-table.cell>
                            <x-table.cell>{{ $store->address }}</x-table.cell>
                            <x-table.cell>
                                {{ $store->updated_at ? $store->updated_at->diffForHumans() : null }}
                            </x-table.cell>
                            <x-table.cell>
                                <x-button
                                    wire:click="$dispatch('openModal', { component: 'store-modal', arguments: { store: {{ $store->id  }} }})"
                                    class="mb-4">
                                    edit
                                </x-button>
                                <x-danger-button wire:click='confirmStoreDeletion({{ $store->id }})'>
                                    delete
                                </x-danger-button>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <tr class=" bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50
                                          dark:hover:bg-gray-600
                                ">
                            <td class="px-6 py-4">No User Found!</td>
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
                {{ $stores->links() }}
            </div>
        </div>
        <!-- Delete Store Modal -->
        <x-dialog-modal wire:model.live="confirmingStoreDeletion">
            <x-slot name="title">
                {{ __('Delete Store') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to permanently delete this store?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="set('confirmingStoreDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteStore({{ $confirmingStoreDeletion }})"
                                 wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
