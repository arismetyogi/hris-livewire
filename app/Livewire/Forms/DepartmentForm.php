<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DepartmentForm extends Form
{
    public ?Department $department;

    #[Validate('unique:departments', as: 'Department ID')]
    public $id;
    #[Validate('string|min:3', as: 'Department Name')]
    public $name;

    public function setDepartment(Department $department): void
    {
        $this->department = $department;

        $this->id = $department->id;
        $this->name = $department->name;
    }

    public function store(): void
    {
        Department::create($this->except(['department']));
        $this->reset();
    }

    public function update(): void
    {
        $this->department->update($this->except(['department']));
    }
}
