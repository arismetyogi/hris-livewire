<?php

namespace App\Livewire\Zip;

use App\Livewire\Forms\ZipForm;
use App\Livewire\ZipsPage;
use Livewire\Component;

class Create extends Component
{
    public ZipForm $form;
    public $createZipModal = false;
    public $formTitle = 'Add a New Zip';

    public function save(): void
    {
        $this->validate();
        // panggil method store dari ZipForm
        $simpan = $this->form->store();

        is_null($simpan)
            ? $this->dispatch('notify', title: 'success', message: 'Data berhasil disimpan')
            : $this->dispatch('notify', title: 'failed', message: 'Data gagal disimpan!');
        $this->createZipModal = false;
        // refresh Users Page after saving
        $this->dispatch('dispatch-create-department-saved')->to(ZipsPage::class);
    }

    public function render()
    {
        return view('livewire.zip.create');
    }
}
