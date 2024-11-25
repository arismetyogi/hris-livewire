<?php

namespace App\Livewire\Department;

use App\Livewire\DepartmentsPage;
use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public DepartmentForm $form;
    public $editDepartmentModal = false;
    public $formTitle = 'Update Department Details';

    #[On('dispatch-edit-department')]
    public function set_department(Department $id)
    {
        dd($id);
        $this->form->setDepartment($id);
        $this->editDepartmentModal = true;
    }

    public function edit()
    {
        $this->validate();
        $update = $this->form->update();
        is_null($update)
            ? $this->dispatch('notify', title: 'success', message: 'Department updated successfully!')
            : $this->dispatch('notify', title: 'failed', message: 'Department failed to update!');
        $this->dispatch('dispatch-edit-department-saved')->to(DepartmentsPage::class);
    }

    public function render()
    {
        return view('livewire.department.edit');
    }
}
