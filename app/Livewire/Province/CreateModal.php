<?php

namespace App\Livewire\Province;

use App\Livewire\Forms\ProvinceForm;
use App\Models\Province;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateModal extends ModalComponent
{
    public ?Province $province = null;
    public ProvinceForm $form;
    public $formTitle = 'Province';

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function mount(?Province $province = null): void
    {
        if ($province && $province->exists) {
            $this->form->setProvince($province);
        }
    }

    public function save(): void
    {
        $saved = $this->form->save();

        is_null($saved)
            ? $this->dispatch('notify', title: 'success', message: 'Data berhasil disimpan')
            : $this->dispatch('notify', title: 'failed', message: 'Data gagal disimpan!');
        $this->closeModal();
        $this->dispatch('refresh-province-list')->to(Index::class);
    }

    public function render(): View
    {
        return view('livewire.province.create-modal');
    }
}
