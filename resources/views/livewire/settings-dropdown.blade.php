@php

    use App\Livewire\Actions\Logout;
    use Livewire\Volt\Component;

    new class extends Component {
        /**
         * Log the current user out of the application.
         */
        public function logout(Logout $logout): void
        {
            $logout();

            $this->redirect('/', navigate: true);
        }
    };

@endphp

<div class="flex flex-row md:flex-1 items-center justify-end gap-2">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-primary-800 dark:text-primary-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <button
                        class="flex text-sm items-center gap-4 transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                        <img class="object-cover w-8 h-8 rounded-full"
                             src="{{ Auth::user()->profile_photo_url }}"
                             alt="{{ auth()->user()->first_name .' '. auth()->user()->last_name }}"/>
                        <div
                            x-data="{{ json_encode(['name' => auth()->user()->first_name .' '. auth()->user()->last_name]) }}"
                            x-text="name"
                            x-on:profile-updated.window="name = $event.detail.name"></div>

                        <div class="ms-1">
                            <x-heroicon-o-chevron-down class="h-4 w-4"/>
                        </div>
                    </button>
                @else
                    <div
                        x-data="{{ json_encode(['name' => auth()->user()->first_name .' '. auth()->user()->last_name]) }}"
                        x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>

                    <div class="ms-1">
                        <x-heroicon-o-chevron-down class="h-4 w-4"/>
                @endif
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.show')" wire:navigate icon="heroicon-o-pencil">
                {{ __('Profile') }}
            </x-dropdown-link>

            <!-- Authentication -->
            <button wire:click="logout" class="w-full text-start ">
                <x-dropdown-link icon="heroicon-o-arrow-left-start-on-rectangle" class="text-red-500">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </button>
        </x-slot>
    </x-dropdown>
</div>
