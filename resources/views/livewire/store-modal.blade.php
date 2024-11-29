<div class="p-6">
    <form wire:submit="save">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.department_id" value="{{ __('Department') }}"/>
            <select class="block w-full mt-1"
                    wire:model="form.department_id"
                    required>
                <option disabled value="">Select Department</option>
                @foreach(\App\Models\Department::orderBy('name')->get() as $department)
                    <option value="{{ $department->id}}">{{ $department->name }}</option>
                @endforeach
            </select>
            <x-input-error for="form.department_id" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.outlet_sap_id" value="{{ __('SAP ID') }}"/>
            <x-input id="form.outlet_sap_id" type="text" class="block w-full mt-1" wire:model="form.outlet_sap_id"
                     autocomplete="store.outlet_sap_id"/>
            <x-input-error for="form.outlet_sap_id" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.name" value="{{ __('Name') }}"/>
            <x-input id="form.name" type="text" class="block w-full mt-1" wire:model="form.name"
                     autocomplete="store.name"/>
            <x-input-error for="form.name" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.operational_date" value="{{ __('Operational On') }}"/>
            <x-input id="form.operational_date" type="date" class="block w-full mt-1" wire:model="form.operational_date"
                     autocomplete="store.operational_date"/>
            <x-input-error for="form.operational_date" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.store_type" value="{{ __('Store Type') }}"/>
            <x-input id="form.store_type" type="text" class="block w-full mt-1" wire:model="form.store_type"
                     autocomplete="store.store_type"/>
            <x-input-error for="form.store_type" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.address" value="{{ __('Address') }}"/>
            <x-input id="form.address" type="text" class="block w-full mt-1" wire:model="form.address"
                     autocomplete="store.address"/>
            <x-input-error for="form.address" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.latitude" value="{{ __('Latitude') }}"/>
            <x-input id="form.latitude" type="text" class="block w-full mt-1" wire:model="form.latitude"
                     autocomplete="store.latitude"/>
            <x-input-error for="form.latitude" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.longitude" value="{{ __('Longitude') }}"/>
            <x-input id="form.longitude" type="text" class="block w-full mt-1" wire:model="form.longitude"
                     autocomplete="store.longitude"/>
            <x-input-error for="form.longitude" class="mt-2"/>
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-label for="form.phone" value="{{ __('Latitude') }}"/>
            <x-input id="form.phone" type="text" class="block w-full mt-1" wire:model="form.phone"
                     autocomplete="store.phone"/>
            <x-input-error for="form.phone" class="mt-2"/>
        </div>
        <div class="mt-4">
            <x-button>
                Save
            </x-button>
        </div>
    </form>
</div>
