<?php

namespace App\Livewire\Zip;

use App\Livewire\Forms\ZipForm;
use App\Models\Zip;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateModal extends ModalComponent
{
    public ?Zip $zip = null;
    public ZipForm $form;
    public $formTitle = 'Zip Code';

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function mount(Zip $zip = null): void
    {
        if ($zip && $zip->exists) {
            $this->form->setZip($zip);
        }
    }

    public function save(): void
    {
        $saved = $this->form->save();
        is_null($saved)
            ? $this->dispatch('notify', title: 'success', message: 'Data berhasil disimpan')
            : $this->dispatch('notify', title: 'failed', message: 'Data gagal disimpan!');
        $this->closeModal();
        $this->dispatch('refresh-zip-list')->to(Index::class);
    }

    public function render(): View
    {
        return view('livewire.zip.create-modal');
    }
}
