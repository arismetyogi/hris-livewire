<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Departments')]
// refresh page on save
#[On('refresh-department-list')]
#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public
        $search = '',
        $perPage = '5',
        $sortField = 'updated_at',
        $sortDirection = 'desc',
        $confirmingDepartmentDeletion = false;

    protected $queryString = ['search', 'sortField', 'sortDirection'];

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

        return view('livewire.department.index', [
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

}
