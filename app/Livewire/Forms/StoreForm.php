<?php

namespace App\Livewire\Forms;

use App\Models\Store;
use Illuminate\Validation\Rule;
use Livewire\Form;

class StoreForm extends Form
{
    public ?Store $store = null;

    public
        $department_id,
        $outlet_sap_id,
        $name,
        $store_type = 'NONE',
        $operational_date,
        $address,
        $phone,
        $latitude,
        $longitude;

    public function rules(): array
    {
        return [
            'department_id' => ['required'],
            'outlet_sap_id' => ['required', Rule::unique('stores')->ignore($this->store)],
            'name' => ['required', 'min:5'],
            'store_type' => ['required'],
            'operational_date' => ['required', 'date'],
            'address' => ['required', 'string', 'min:10'],
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'phone' => ['required', 'regex:/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'],
        ];
    }

//    public function validationAttributes(): array
//    {
//        return [
//            'department_id' => 'department_id',
//            'outlet_sap_id' => 'outlet_sap_id',
//            'name' => 'name',
//            'store_type' => 'store_type',
//            'operational_date' => 'operational_date',
//            'address' => 'address',
//            'phone' => 'phone',
//            'latitude' => 'latitude',
//            'longitude' => 'longitude',
//        ];
//    }

    public function setStore(?Store $store = null): void
    {
        $this->store = $store;

        $this->department_id = $store->department_id;
        $this->outlet_sap_id = $store->outlet_sap_id;
        $this->name = $store->name;
        $this->store_type = $store->store_type;
        $this->operational_date = $store->operational_date;
        $this->address = $store->address;
        $this->phone = $store->phone;
        $this->latitude = $store->latitude;
        $this->longitude = $store->longitude;
    }

    public function save(): void
    {
        $this->validate();
        if (!$this->store) {
            Store::create($this->except(['store']));
        } else {
            $this->store->update($this->only(['outlet_sap_id', 'name', 'store_type', 'address', 'phone', 'latitude', 'longitude']));
        }
        $this->reset();
    }

}
