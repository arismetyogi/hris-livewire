<div>
    <x-button @click="$wire.set('createDepartmentModal','true')">Add New Department</x-button>
    <x-dialog-modal id="createDepartmentModal" wire:model.live="createDepartmentModal" submit="save">
        <x-slot name="title">
            {{ $formTitle }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4 sm:grid-cols-8">
                <!-- ID -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.id" value="{{ __('Department ID') }}"/>
                    <x-input id="form.id" type="text" class="block w-full mt-1" wire:model="form.id"
                             required autocomplete="user.id"/>
                    <x-input-error for="form.id" class="mt-2"/>
                </div>

                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.name" value="{{ __('Department Name') }}"/>
                    <x-input id="form.name" type="text" class="block w-full mt-1" wire:model="form.name"
                             autocomplete="user.name"/>
                    <x-input-error for="form.name" class="mt-2"/>
                </div>
                
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="set('createDepartmentModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
