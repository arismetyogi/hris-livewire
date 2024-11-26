<?php

namespace App\Livewire\Province;

use App\Livewire\Forms\ProvinceForm;
use App\Livewire\ProvincesPage;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public ProvinceForm $form;
    public $createProvinceModal = false;
    public $formTitle = 'Add a New Province';

    public function save(): void
    {
        $this->validate();
        // panggil method store dari ProvinceForm
        $simpan = $this->form->store();

        is_null($simpan)
            ? $this->dispatch('notify', title: 'success', message: 'Data berhasil disimpan')
            : $this->dispatch('notify', title: 'failed', message: 'Data gagal disimpan!');
        $this->createProvinceModal = false;
        // refresh Users Page after saving
        $this->dispatch('dispatch-create-department-saved')->to(ProvincesPage::class);
    }

    public function render(): View
    {
        return view('livewire.province.create');
    }
}
