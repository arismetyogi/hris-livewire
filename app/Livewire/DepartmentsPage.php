<?php

namespace App\Livewire;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Departments')]
// refresh page on save
#[On('dispatch-create-department-saved')]
#[On('dispatch-edit-department-saved')]
class DepartmentsPage extends Component
{
    use WithPagination;

    public DepartmentForm $form;

    public
        $search = '',
        $perPage = '5',
        $sortField = 'updated_at',
        $sortDirection = 'desc',
        $confirmingDepartmentDeletion = false,
        $confirmingDepartmentAddition = false,
        $editDepartmentModal = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render(): View
    {
        $departments = Department::where(function ($query) {
            // Apply search conditions for id and name
            $query
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.departments-page', [
            'departments' => $departments
        ]);
    }

    public function confirmDepartmentDeletion($id): void
    {
        $this->confirmingDepartmentDeletion = $id;
    }

    public function deleteDepartment(Department $department): void
    {
        $department->delete();
        $this->confirmingDepartmentDeletion = false;
    }

    public function editDepartment(Department $id): void
    {
        $this->form->setDepartment($id);
        $this->editDepartmentModal = true;
    }

    public function edit(): void
    {
        $this->validate();
        // panggil method store dari DepartmentForm
        $update = $this->form->update();
        is_null($update)
            ? $this->dispatch('notify', title: 'success', message: 'Department updated successfully!')
            : $this->dispatch('notify', title: 'failed', message: 'Failed to update department!');
        $this->dispatch('dispatch-edit-department-saved')->to(DepartmentsPage::class);
    }
}
