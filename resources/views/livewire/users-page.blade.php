<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __("Users") }}
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
                            d="m1 1 4 4 4-4" />
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
                <livewire:user.create />

            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.350="search" type="text" id="table-search"
                    class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users" />
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    @include('livewire.includes.th-with-sort', [
                    'name' => 'users.first_name',
                    'displayName' => 'name'
                    ])
                    @include('livewire.includes.th-no-sort', [
                    'name' => 'role'
                    ])
                    @include('livewire.includes.th-no-sort', [
                    'name' => 'status'
                    ])
                    @include('livewire.includes.th-with-sort', [
                    'name' => 'users.updated_at',
                    'displayName' => 'last update'
                    ])
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-{{ $user->id }}" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="checkbox-table-search-{{ $user->id }}" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="{{ $user->profile_photo_url }}"
                            alt="{{ $user->username }}" />
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ $user->first_name . ' ' . $user->last_name }}</div>
                            <div class="font-normal text-gray-500">
                                {{ $user->email }}
                            </div>
                        </div>
                    </th>
                    <!-- Role -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            {{ $user->email_verified_at }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div>
                            {{ 'online status' }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            {{ $user->updated_at->diffForHumans() }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <!-- Modal toggle -->
                        <x-button class="tracking-widest bg-orange-500 hover:bg-orange-400">󰚼</x-button>
                        <x-danger-button wire:click='confirmUserDeletion({{ $user->id }})'>󰗨</x-danger-button>
                    </td>
                </tr>
                @empty
                <trclass="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50
                    dark:hover:bg-gray-600">
                    <td class="px-6 py-4">No Users Found!</td>
                    </tr>
                    @endforelse

            </tbody>
        </table>

        <div class="flex flex-wrap items-center justify-between py-12 space-y-4 flex-column md:flex-row md:space-y-0">
            <div wire:model.live="perPage">
                <label for="perPage">per Page:</label>
                <select id="perPage" class="border-gray-300 rounded">
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
            </div>
            <div>
                {{ $users->links() }}
            </div>
        </div>
        <!-- Delete User Modal -->
        <x-dialog-modal wire:model.live="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Delete Account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to permanently delete this account?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="set('confirmingUserDeletion', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3" wire:click="deleteUser({{ $confirmingUserDeletion }})"
                    wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
