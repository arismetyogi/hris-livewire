<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use Livewire\Component;

class Create extends Component
{
    public UserForm $form;
    public $createUserModal = false;
    public function save()
    {
        $this->validate();
        // panggil method store dari UserForm
        $simpan = $this->form->store();

        is_null($simpan)
            ? $this->dispatch('notify', title: 'success', message: 'Data berhasil disimpan')
            : $this->dispatch('notify', title: 'failed', message: 'Data gagal disimpan!');
        $this->createUserModal = false;
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
