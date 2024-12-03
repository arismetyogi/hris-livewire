<div class="overflow-x-auto shadow-md sm:rounded-lg">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __("Users") }}
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
                           placeholder="Search for users"/>
                </div>
            </div>
            <div class="flex justify-end mb-4 gap-x-4">
                <x-secondary-button>
                    <a href="{{ route('user.export')}}" class="flex gap-2">
                        export
                        <x-heroicon-o-document-arrow-down class="w-4 h-4"/>
                    </a>
                </x-secondary-button>
                <x-button wire:click="$dispatch('openModal', { component: 'user.create-modal' })">add new
                    user
                </x-button>
            </div>
        </div>

        <div class="p-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <x-table>
                <x-slot name="head">
                    {{--                    <x-table.heading sortable>No</x-table.heading>--}}
                    <x-table.heading sortable wire:click="sortBy('first_name')"
                                     :direction="'first_name' ? $sortDirection : null">Name
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
                                <x-button
                                    wire:click="$dispatch('openModal', { component: 'user.create-modal', arguments: { user: {{ $user->id }} }})">
                                    edit
                                </x-button>
                                <x-danger-button
                                    wire:click="$dispatch('openModal', { component: 'delete-modal', arguments: {model: 'User', recordId: {{ $user->id}} }})">
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

    </div>

</div>
