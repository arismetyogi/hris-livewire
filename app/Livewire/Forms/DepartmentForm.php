<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use Livewire\Form;

class DepartmentForm extends Form
{
    public ?Department $department = null;

    public $id, $name;

    public function rules(): array
    {
        return [
            'id' => 'required|integer|digits:4|unique:departments,id',
            'name' => 'required|string|min:3|unique:departments,name',
        ];
    }

    public function setDepartment(?Department $department = null): void
    {
        $this->department = $department;

        $this->id = $department->id;
        $this->name = $department->name;
    }

    public function save(): void
    {
        $this->validate();
        if (!$this->department) {
            Department::create($this->except(['department']));
        } else {
            $this->department->update($this->except(['department']));
        }
        $this->reset();
    }

}
