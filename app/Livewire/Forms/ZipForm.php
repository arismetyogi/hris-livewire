<?php

namespace App\Livewire\Forms;

use App\Models\Zip;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ZipForm extends Form
{
    public ?Zip $zip;

    public
        $province_code,
        $zipcode,
        $urban,
        $subdistrict,
        $city;

    public function rules(): array
    {
        return [
            'province_code' => ['required'],
            'zipcode' => ['required', 'integer', 'digits:5', Rule::unique('zips')->ignore($this->zip)],
            'urban' => ['required', 'min:5'],
            'subdistrict' => ['required', 'min:5'],
            'city' => ['required', 'min:5'],
        ];
    }

    public function setZip(Zip $zip): void
    {
        $this->zip = $zip;

        $this->province_code = $zip->province_code;
        $this->zipcode = $zip->zipcode;
        $this->urban = $zip->urban;
        $this->subdistrict = $zip->subdistrict;
        $this->city = $zip->city;
    }

    public function save(): void
    {
        $this->validate();
        if (!$this->store) {
            Zip::create($this->except(['store']));
        } else {
            $this->store->update($this->except(['store', 'province_code']));
        }
        $this->reset();
    }
}
