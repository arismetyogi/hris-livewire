<?php

namespace App\Livewire\Department;

use App\Livewire\DepartmentsPage;
use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
    public DepartmentForm $form;
    public $editDepartmentModal = false;
    public $formTitle = 'Update Department Details';

    #[On('dispatch-edit-department')]
    public function set_department(Department $id): void
    {
        logger('dispatch received with data' . $id);
        @dump($id);
        $this->form->setDepartment($id);
        $this->editDepartmentModal = true;
    }

    public function edit(): void
    {
        $this->validate();
        $update = $this->form->update();
        is_null($update)
            ? $this->dispatch('notify', title: 'success', message: 'Department updated successfully!')
            : $this->dispatch('notify', title: 'failed', message: 'Failed to update department!');
        $this->dispatch('dispatch-edit-department-saved')->to(DepartmentsPage::class);
    }

    public function render(): View
    {
        return view('livewire.department.edit');
    }
}
