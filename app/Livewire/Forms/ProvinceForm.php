<?php

namespace App\Livewire\Forms;

use App\Models\Province;
use Illuminate\Validation\Rule;
use Livewire\Form;

class ProvinceForm extends Form
{
    public ?Province $province = null;

    public $name, $code, $name_en;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255',
                Rule::unique('provinces', 'name')->ignore($this->province)],
            'name_en' => ['required', 'string', 'min:3', 'max:255',
                Rule::unique('provinces', 'name_en')->ignore($this->province)],
            'code' => ['required', 'integer', 'digits:2',
                Rule::unique('provinces', 'code')->ignore($this->province)],
        ];
    }

    public function setProvince(?Province $province = null): void
    {
        $this->province = $province;

        $this->name = $province->name;
        $this->name_en = $province->name_en;
        $this->code = $province->code;
    }

    public function save(): void
    {
        $this->validate();
        if (!$this->province) {
            Province::create($this->except(['province']));
        } else {
            $this->province->update($this->except(['province', 'code']));
        }
        $this->reset();
    }
}
