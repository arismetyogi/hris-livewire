<?php

namespace App\Livewire\Forms;

use App\Models\Zip;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ZipForm extends Form
{
    public ?Zip $zip = null;

    public
        $province_code,
        $city,
        $subdistrict,
        $urban,
        $zipcode;

    public function rules(): array
    {
        return [
            'province_code' => ['required'],
            'city' => ['required', 'min:5'],
            'subdistrict' => ['required', 'min:5'],
            'urban' => ['required', 'min:5'],
            'zipcode' => ['required', 'integer', 'digits:5', Rule::unique('zips', ['zipcode', 'urban', 'province_code'])->ignore($this->zip)],
        ];
    }

    public function setZip(?Zip $zip = null): void
    {
        $this->zip = $zip;

        $this->province_code = $zip->province_code;
        $this->city = $zip->city;
        $this->subdistrict = $zip->subdistrict;
        $this->urban = $zip->urban;
        $this->zipcode = $zip->zipcode;
    }

    public function save(): void
    {
        $this->validate();
        if (!$this->zip) {
            Zip::create($this->except(['zip']));
        } else {
            $this->zip->update($this->except(['zip', 'province_code']));
        }
        $this->reset();
    }
}
