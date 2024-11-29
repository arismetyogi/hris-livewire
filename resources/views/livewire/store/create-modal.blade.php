<div class="p-6 max-w-4xl">
    <div class="flex mt-3 mb-5 justify-center font-semibold text-xl">
        @if(!$this->store)
            Add a New {{ $formTitle }}
        @else
            Edit {{ $formTitle }}
        @endif
    </div>
    <form wire:submit="save">
        <div class="grid grid-cols-8 gap-4 sm:grid-cols-6">
            <div class="col-span-full">
                <x-label for="form.department_id" value="{{ __('Department') }}"/>
                <select class="block w-full mt-1"
                        wire:model="form.department_id"
                        @if($this->store) disabled @endif
                        required>
                    <option disabled value="">Select Department</option>
                    @foreach(\App\Models\Department::orderBy('name')->get() as $department)
                        <option value="{{ $department->id}}">{{ $department->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="form.department_id" class="mt-2"/>
            </div>
            <div class="col-span-2 sm:col-span-2">
                <x-label for="form.outlet_sap_id" value="{{ __('SAP ID') }}"/>
                <x-input id="form.outlet_sap_id" type="text" class="block w-full mt-1" wire:model="form.outlet_sap_id"
                         autocomplete="store.outlet_sap_id" :disabled="$this->store"/>
                <x-input-error for="form.outlet_sap_id" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="form.name" value="{{ __('Name') }}"/>
                <x-input id="form.name" type="text" class="block w-full mt-1" wire:model="form.name"
                         autocomplete="store.name"/>
                <x-input-error for="form.name" class="mt-2"/>
            </div>
            <div class="col-span-full">
                <x-label for="form.address" value="{{ __('Address') }}"/>
                <x-input id="form.address" type="text" class="block w-full mt-1" wire:model="form.address"
                         autocomplete="store.address"/>
                <x-input-error for="form.address" class="mt-2"/>
            </div>
            <div class="col-span-3">
                <x-label for="form.operational_date" value="{{ __('Operational On') }}"/>
                <x-input id="form.operational_date" type="date" class="block w-full mt-1"
                         wire:model="form.operational_date"
                         autocomplete="store.operational_date"/>
                <x-input-error for="form.operational_date" class="mt-2"/>
            </div>
            <div class="col-span-3">
                <x-label for="form.store_type" value="{{ __('Store Type') }}"/>
                <x-input id="form.store_type" type="text" class="block w-full mt-1" wire:model="form.store_type"
                         autocomplete="store.store_type"/>
                <x-input-error for="form.store_type" class="mt-2"/>
            </div>
            <div class="col-span-4 sm:col-span-3">
                <x-label for="form.latitude" value="{{ __('Latitude') }}"/>
                <x-input id="form.latitude" type="text" class="block w-full mt-1" wire:model="form.latitude"
                         autocomplete="store.latitude"/>
                <x-input-error for="form.latitude" class="mt-2"/>
            </div>
            <div class="col-span-4 sm:col-span-3">
                <x-label for="form.longitude" value="{{ __('Longitude') }}"/>
                <x-input id="form.longitude" type="text" class="block w-full mt-1" wire:model="form.longitude"
                         autocomplete="store.longitude"/>
                <x-input-error for="form.longitude" class="mt-2"/>
            </div>
            <div class="col-span-full sm:col-span-full">
                <x-label for="form.phone" value="{{ __('Phone') }}"/>
                <x-input id="form.phone" type="text" class="block w-full mt-1" wire:model="form.phone"
                         autocomplete="store.phone"/>
                <x-input-error for="form.phone" class="mt-2"/>
            </div>
        </div>

        <hr class="mt-3">

        <div class="mt-6">
            <x-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
</div>
