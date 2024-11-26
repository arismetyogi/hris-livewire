<div>
    <x-button @click="$wire.set('createProvinceModal','true')">Add New Province</x-button>
    <x-dialog-modal id="createProvinceModal" wire:model.live="createProvinceModal" submit="save">
        <x-slot name="title">
            {{ $formTitle }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4 sm:grid-cols-8">
                <!-- ID -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.code" value="{{ __('Province Code') }}"/>
                    <x-input id="form.code" type="text" class="block w-full mt-1" wire:model="form.code"
                             required autocomplete="province.code"/>
                    <x-input-error for="form.code" class="mt-2"/>
                </div>

                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.name" value="{{ __('Province Name') }}"/>
                    <x-input id="form.name" type="text" class="block w-full mt-1" wire:model="form.name"
                             autocomplete="province.name"/>
                    <x-input-error for="form.name" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.name_en" value="{{ __('Province Name (EN)') }}"/>
                    <x-input id="form.name_en" type="text" class="block w-full mt-1" wire:model="form.name_en"
                             autocomplete="province.name_en"/>
                    <x-input-error for="form.name_en" class="mt-2"/>
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="set('createProvinceModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
