<?php

namespace App\Livewire;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use LivewireUI\Modal\ModalComponent;

class DepartmentModal extends ModalComponent
{
    public ?Department $department = null;
    public DepartmentForm $form;
    public $formTitle = "Department";

    public static function modalMaxWidth(): string
    {
        return '6xl';
    }

    public function mount(?Department $department = null): void
    {
        if ($department && $department->exists) {
            $this->form->setDepartment($department);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-department-list')->to('departments-page');
    }

    public function render()
    {
        return view('livewire.department-modal');
    }
}
