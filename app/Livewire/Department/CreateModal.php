<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateModal extends ModalComponent
{
    public ?Department $department = null;
    public DepartmentForm $form;
    public $formTitle = "Department";

    public static function modalMaxWidth(): string
    {
        return '2xl';
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
        $this->dispatch('refresh-department-list')->to(Index::class);
    }

    public function render(): View
    {
        return view('livewire.department.create-modal');
    }
}
