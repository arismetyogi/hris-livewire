<div class="p-6 w-full">
    <div class="flex mt-3 mb-5 justify-center font-semibold text-xl">
        @if(!$this->province)
            Add a New {{ $formTitle }}
        @else
            Edit {{ $formTitle }}
        @endif
    </div>
    <form wire:submit="save">
        <div class="grid grid-cols-12 gap-4 sm:grid-cols-8">
            <!-- ID -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="form.code" value="{{ __('Province Code') }}"/>
                <x-input id="form.code" type="text" class="block w-full mt-1" wire:model="form.code"
                         required autocomplete="province.code" :disabled="$this->province"/>
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
        <hr class="mt-3">
        <div class="mt-9 flex mb-3 justify-center font-semibold">
            <x-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </div>

    </form>
</div>
