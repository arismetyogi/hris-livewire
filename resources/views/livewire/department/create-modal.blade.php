<div class="p-6 w-full">
    <x-slot name="title">
        {{ $formTitle }}
    </x-slot>

    <form wire:submit="save" name="content">
        <div class="grid grid-cols-8 gap-4 sm:grid-cols-6">
            <!-- ID -->
            <div class="col-span-1 sm:col-span-2">
                <x-label for="form.id" value="{{ __('Department ID') }}"/>
                <x-input id="form.id" type="text" class="block w-full mt-1" wire:model="form.id"
                         required autocomplete="department.id"/>
                <x-input-error for="form.id" class="mt-2"/>
            </div>

            <!-- Name -->
            <div class="col-span-7 sm:col-span-4">
                <x-label for="form.name" value="{{ __('Department Name') }}"/>
                <x-input id="form.name" type="text" class="block w-full mt-1" wire:model="form.name"
                         autocomplete="department.name"/>
                <x-input-error for="form.name" class="mt-2"/>
            </div>

        </div>
        <div class="mt-4">
            <x-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </div>
    </form>

</div>
