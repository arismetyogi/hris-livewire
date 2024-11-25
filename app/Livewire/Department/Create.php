<?php

namespace App\Livewire\Department;

use App\Livewire\DepartmentsPage;
use App\Livewire\Forms\DepartmentForm;
use Livewire\Component;

class Create extends Component
{
    public DepartmentForm $form;
    public $createDepartmentModal = false;
    public $formTitle = 'Add a New Department';

    public function save()
    {
        $this->validate();
        // panggil method store dari DepartmentForm
        $simpan = $this->form->store();

        is_null($simpan)
            ? $this->dispatch('notify', title: 'success', message: 'Data berhasil disimpan')
            : $this->dispatch('notify', title: 'failed', message: 'Data gagal disimpan!');
        $this->createDepartmentModal = false;
        // refresh Users Page after saving
        $this->dispatch('dispatch-department.create-save')->to(DepartmentsPage::class);
    }

    public function render()
    {
        return view('livewire.department.create');
    }
}
