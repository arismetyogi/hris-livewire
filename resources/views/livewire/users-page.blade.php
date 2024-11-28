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
            <livewire:user.create/>
        </div>

        <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="text-secondary-500 font-semibold text-xl my-4 py-4 px-8">Users</div>
            <x-table>
                <x-slot name="head">
                    <x-table.heading></x-table.heading>
                    {{--                    <x-table.heading sortable>No</x-table.heading>--}}
                    <x-table.heading sortable wire:click="sortBy('first_name')"
                                     :direction="$sortField === 'first_name' ? $sortDirection : null">Name
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('department_name')"
                                     :direction="$sortField === 'department_name' ? $sortDirection : null">Department
                    </x-table.heading>
                    <x-table.heading sortable>Role</x-table.heading>
                    <x-table.heading sortable>Status
                    </x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('users.updated_at')"
                                     :direction="$sortField === 'users.updated_at' ? $sortDirection : null">Last Update
                    </x-table.heading>
                    <x-table.heading sortable>Action</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @forelse($users as $user)
                        <x-table.row>
                            <x-table.cell>
                                <div class="flex items-center">
                                    <input id="checkbox-all-search" type="checkbox"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                                    <label for="checkbox-all-search" class="sr-only">check</label>
                                </div>
                            </x-table.cell>
                            {{--                            <x-table.cell>{{ $users->firstItem() + $loop->index }}</x-table.cell>--}}
                            <x-table.cell class="flex">
                                <img class="w-10 h-10 rounded-full" src="{{ $user->profile_photo_url }}"
                                     alt="{{ $user->username }}"/>
                                <div class="ps-3">
                                    <div
                                        class="text-base font-semibold">{{ $user->first_name . ' ' . $user->last_name }}</div>
                                    <div class="font-normal text-gray-500">
                                        {{ $user->email }}
                                    </div>
                                    <div class="font-light text-sm text-gray-500">
                                        {{ $user->username }}
                                    </div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>{{ $user->department ? $user->department->name : null }}</x-table.cell>
                            <x-table.cell>{{ $user->currentTeam ? $user->currentTeam->name : null }}</x-table.cell>
                            <x-table.cell>
                                <div class="flex-col items-center">
                                    @php
                                        $session = $this->sessions->firstWhere('user_id', $user->id);
                                        $lastActive = $session ? $session->last_active : 'offline';
                                    @endphp
                                    @if( $lastActive === 'offline')
                                        <div class="flex items-center text-red-600">
                                            <span class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2 "></span>
                                            Offline
                                        </div>
                                    @else
                                        <div class="flex items-center text-green-600">
                                            <span
                                                class="h-2.5 w-2.5 rounded-full animate-ping bg-green-500 mr-2"></span>
                                            <span>Online</span>
                                        </div>
                                    @endif
                                    <div
                                        class="text-xs font-light">{{ $user->last_activity ? \Carbon\Carbon::parse($user->last_activity)->diffForHumans() : null }}</div>
                                </div>
                            </x-table.cell>
                            <x-table.cell>
                                {{ $user->updated_at ? $user->updated_at->diffForHumans() : null }}
                            </x-table.cell>
                            <x-table.cell>
                                <x-button wire:click="editUser({{ $user->id }})" type="button"
                                          class="tracking-widest bg-orange-500 hover:bg-orange-400">
                                    <x-heroicon-o-user-circle class="h-4 w-4 text-white"/>
                                    edit
                                </x-button>
                                <x-danger-button wire:click='confirmUserDeletion({{ $user->id }})'>
                                    <x-heroicon-c-user-minus class="h-4 w-4 text-white"/>
                                    delete
                                </x-danger-button>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
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
        <!-- Edit User Modal -->
        <x-dialog-modal id="editUserModal" wire:model.live="editUserModal" submit="edit">
            <x-slot name="title">
                {{ __('Edit User') }}
            </x-slot>

            <x-slot name="content">
                <div class="grid grid-cols-12 gap-4 sm:grid-cols-8">
                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="form.first_name" value="{{ __('First Name') }}"/>
                        <x-input id="form.first_name" type="text" class="block w-full mt-1" wire:model="form.first_name"
                                 required autocomplete="user.first_name"/>
                        <x-input-error for="form.first_name" class="mt-2"/>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="form.last_name" value="{{ __('Last Name') }}"/>
                        <x-input id="form.last_name" type="text" class="block w-full mt-1" wire:model="form.last_name"
                                 autocomplete="user.last_name"/>
                        <x-input-error for="form.last_name" class="mt-2"/>
                    </div>

                    <!-- userName -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="form.username" value="{{ __('Username') }}"/>
                        <x-input id="form.username" type="text" class="block w-full mt-1" wire:model="form.username"
                                 required autocomplete="user.username"/>
                        <x-input-error for="form.username" class="mt-2"/>
                    </div>

                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="form.email" value="{{ __('Email') }}"/>
                        <x-input id="form.email" type="email" class="block w-full mt-1" wire:model="form.email" required
                                 autocomplete="user.email"/>
                        <x-input-error for="form.email" class="mt-2"/>
                    </div>
                    <!-- Department -->
                    <div class="col-span-full">
                        <x-label for="form.department_id" value="{{ __('Department') }}"/>
                        <select class="block w-full mt-1"
                                wire:model="form.department_id"
                                required>
                            <option disabled value="">Select Department</option>
                            @foreach(\App\Models\Department::all() as $department)
                                <option value="{{ $department->id}}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="form.password" value="{{ __('Password') }}"/>
                        <x-input id="form.password" type="password" class="block w-full mt-1" wire:model="form.password"
                                 required autocomplete="new-password"/>
                        <x-input-error for="form.password" class="mt-2"/>
                    </div>

                    <!-- Password Confirmation -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-label for="form.password_confirmation" value="{{ __('Password Confirmation') }}"/>
                        <x-input id="form.password_confirmation" type="password" class="block w-full mt-1"
                                 wire:model="form.password_confirmation" required/>
                        <x-input-error for="form.password_confirmation" class="mt-2"/>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="set('editUserModal', false)" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-button class="ms-3" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
