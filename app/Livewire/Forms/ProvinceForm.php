<?php

namespace App\Livewire\Forms;

use App\Models\Province;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProvinceForm extends Form
{
    public ?Province $province;

    #[Validate('unique:provinces', as: 'Province Name')]
    public $name;
    #[Validate('unique:provinces', as: 'Province Code')]
    public $code;
    #[Validate('string|min:3', as: 'Province Name (EN)')]
    public $name_en;

    public function setProvince(Province $province): void
    {
        $this->province = $province;

        $this->name = $province->name;
        $this->name_en = $province->name_en;
        $this->code = $province->code;
    }

    public function store(): void
    {
        Province::create($this->except(['province']));
        $this->reset();
    }

    public function update(): void
    {
        $this->province->update($this->except(['province']));
    }
}
