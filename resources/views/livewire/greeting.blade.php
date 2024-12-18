<div
    class="grid grid-cols-4 items-center justify-items-start  h-20 bg-white border-b border-gray-200 lg:p-2 lg:h-32"
>
    <x-application-logo class="block w-auto h-14 lg:h-24"/>

    <div class="flex col-span-2 justify-end items-center">
        {{ __('Welcome to') . ' ' . strtoupper(config('app.name')) . ', ' }}
        <a href="{{ route('profile.show') }}" wire:navigate
           class="text-primary-500">{{auth()->user()->first_name . ' ' . auth()->user()->last_name }} </a>!
    </div>
    <h1 class="pr-4 w-fill justify-self-end text-lg font-medium text-gray-600">
        <!-- Authentication -->
        <x-secondary-button wire:click="logout" class="flex items-center gap-1 hover:bg-red-100">
            <x-heroicon-o-arrow-left-on-rectangle class="size-4"/>
            {{ __('Log Out') }}
        </x-secondary-button>
    </h1>
</div>
