<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DepartmentForm extends Form
{
    public ?Department $department;

    #[Validate('unique:', as: 'Department ID')]
    public $id;
    #[Validate('name', as: 'Department Name')]
    public $name;

    public function setDepartment(Department $department)
    {
        $this->department = $this->department ?? new Department();

        $this->id = $department->id;
        $this->name = $department->name;
    }

    public function store()
    {
        Department::create($this->except(['department']));
        $this->reset();
    }

    public function update()
    {
        $this->department->update($this->except(['department']));
    }
}
