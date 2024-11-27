<div>
    <x-button @click="$wire.set('createZipModal','true')">Add New Zip Code</x-button>
    <x-dialog-modal id="createZipModal" wire:model.live="createZipModal" submit="save">
        <x-slot name="title">
            {{ $formTitle }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-12 gap-4 sm:grid-cols-8">
                <!-- ID -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.province_code" value="{{ __('Province') }}"/>
                    <select class="block w-full mt-1"
                            wire:model="form.province_code"
                            required>
                        <option disabled value="">Select Province</option>
                        @foreach(\App\Models\Province::orderBy('name')->get() as $province)
                            <option value="{{ $province->code}}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="form.province_code" class="mt-2"/>
                </div>

                <!-- Urban -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.urban" value="{{ __('Urban') }}"/>
                    <x-input id="form.urban" type="text" class="block w-full mt-1" wire:model="form.urban"
                             autocomplete="zip.urban"/>
                    <x-input-error for="form.urban" class="mt-2"/>
                </div>

                <!-- Subdistrict -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.subdistrict" value="{{ __('Subdistrict') }}"/>
                    <x-input id="form.subdistrict" type="text" class="block w-full mt-1" wire:model="form.subdistrict"
                             autocomplete="zip.subdistrict"/>
                    <x-input-error for="form.subdistrict" class="mt-2"/>
                </div>

                <!-- City -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.city" value="{{ __('City') }}"/>
                    <x-input id="form.city" type="text" class="block w-full mt-1" wire:model="form.city"
                             autocomplete="zip.city"/>
                    <x-input-error for="form.city" class="mt-2"/>
                </div>

                <!-- Zipcode -->
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="form.zipcode" value="{{ __('Zip Code') }}"/>
                    <x-input id="form.zipcode" type="text" class="block w-full mt-1" wire:model="form.zipcode"
                             autocomplete="zip.zipcode"/>
                    <x-input-error for="form.zipcode" class="mt-2"/>
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="set('createZipModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
