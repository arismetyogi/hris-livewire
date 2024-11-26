<?php

namespace App\Livewire\Forms;

use App\Models\Zip;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ZipForm extends Form
{
    public ?ZipForm $form;

    #[Validate('unique:zips', as: 'Urban')]
    public $urban;
    #[Validate('string|min:3', as: 'Subdistrict')]
    public $subdistrict;
    #[Validate('string|min:3', as: 'City')]
    public $city;
    #[Validate('string|min:2|max:3', as: 'Province')]
    public $province_code;
    #[Validate('integer|digits:5', as: 'Zip Code')]
    public $zipcode;

    public function setZip(Zip $zip): void
    {
        $this->zip = $zip;

        $this->urban = $zip->urban;
        $this->subdistrict = $zip->subdistrict;
        $this->city = $zip->city;
        $this->province_code = $zip->province_code;
        $this->zipcode = $zip->zipcode;
    }

    public function store(): void
    {
        Zip::create($this->except(['zip']));
        $this->reset();
    }

    public function update(): void
    {
        $this->zip->update($this->except(['zip']));
    }
}
