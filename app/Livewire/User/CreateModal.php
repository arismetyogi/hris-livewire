<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateModal extends ModalComponent
{
    public ?User $user = null;
    public UserForm $form;
    public $formTitle = 'User';

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(?User $user = null): void
    {
        if ($user && $user->exists) {
            $this->form->setUser($user);
        }
    }

    public function save(): void
    {
        $saved = $this->form->save();

        is_null($saved)
            ? $this->dispatch('notify', title: 'success', message: 'Data berhasil disimpan')
            : $this->dispatch('notify', title: 'failed', message: 'Data gagal disimpan!');
        $this->closeModal();
        // refresh Users Page after saving
        $this->dispatch('refresh-user-list')->to(Index::class);
    }

    public function render(): View
    {
        return view('livewire.user.create-modal');
    }
}
