<?php

namespace App\Livewire;

use App\Models\Department;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Departments')]
// refresh page on save
#[On('dispatch-department.create-save')]
class DepartmentsPage extends Component
{
    use WithPagination;

    public
        $search = '',
        $perPage = '5',
        $sortBy = 'departments.updated_at',
        $sortDir = 'DESC',
        $confirmingDepartmentDeletion = false,
        $confirmingDepartmentAddition = false;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($sortByCol)
    {
        if ($this->sortBy = $sortByCol) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
        }
        $this->sortBy = $sortByCol;
    }

    public function render()
    {
        $departments = Department::where(function ($query) {
            // Apply search conditions for id and name
            $query
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.departments-page', [
            'departments' => $departments
        ]);
    }

    public function confirmDepartmentDeletion($id)
    {
        $this->confirmingDepartmentDeletion = $id;
    }

    public function deleteDepartment(Department $department): void
    {
        $department->delete();
        $this->confirmingDepartmentDeletion = false;
    }

}
