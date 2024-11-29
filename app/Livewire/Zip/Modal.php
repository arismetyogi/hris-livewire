<?php

namespace App\Livewire\Zip;

use App\Livewire\Forms\ZipForm;
use App\Models\Zip;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
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
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-zip-list')->to('zips-page');
    }

    public function render()
    {
        return view('livewire.zip.modal');
    }
}
