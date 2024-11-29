<?php

namespace App\Livewire;

use App\Livewire\Forms\StoreForm;
use App\Models\Store;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class StoreModal extends ModalComponent
{
    public ?Store $store = null;
    public StoreForm $form;

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function mount(?Store $store = null): void
    {
        if ($store && $store->exists) {
            $this->form->setStore($store);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-store-list')->to('stores-page');
    }

    public function render(): View
    {
        return view('livewire.store-modal');
    }
}
