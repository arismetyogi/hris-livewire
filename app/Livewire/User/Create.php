<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Livewire\UsersPage;
use App\Models\Department;
use Livewire\Component;

class Create extends Component
{
    public UserForm $form;

    public $departments;
    public $createUserModal = false;
    public $formTitle = 'Create a New User';

    public function save()
    {
        $this->validate();
        // panggil method store dari UserForm
        $simpan = $this->form->store();

        is_null($simpan)
            ? $this->dispatch('notify', title: 'success', message: 'Data berhasil disimpan')
            : $this->dispatch('notify', title: 'failed', message: 'Data gagal disimpan!');
        $this->createUserModal = false;
        // refresh Users Page after saving
        $this->dispatch('dispatch-user.create-save')->to(UsersPage::class);
    }

    public function render()
    {
        return view('livewire.user.create', [
            'departments' => Department::all(),
        ]);
    }
}
