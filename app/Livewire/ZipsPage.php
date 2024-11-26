<?php

namespace App\Livewire;

use App\Livewire\Forms\ZipForm;
use App\Models\Zip;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Zip Codes')]
// refresh page on save
#[On('dispatch-create-zip-saved')]
#[On('dispatch-edit-zip-saved')]
class ZipsPage extends Component
{
    use WithPagination;

    public ZipForm $form;

    public
        $search = '',
        $perPage = '5',
        $sortField = 'updated_at',
        $sortDirection = 'desc',
        $confirmingZipDeletion = false,
        $confirmingZipAddition = false,
        $editZipModal = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render(): View
    {
        $zips = Zip::where(function ($query) {
            // Apply search conditions for id and name
            $query
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.zips-page', [
            'provinces' => $zips
        ]);
    }

    public function confirmZipDeletion($id): void
    {
        $this->confirmingZipDeletion = $id;
    }

    public function deleteZip(Zip $zip): void
    {
        $zip->delete();
        $this->confirmingZipDeletion = false;
    }

    public function editZip(Zip $id): void
    {
        $this->form->setZip($id);
        $this->editZipModal = true;
    }

    public function edit(): void
    {
        $this->validate();
        // panggil method store dari ZipForm
        $update = $this->form->update();
        is_null($update)
            ? $this->dispatch('notify', title: 'success', message: 'Zip updated successfully!')
            : $this->dispatch('notify', title: 'failed', message: 'Failed to update province!');
        $this->dispatch('dispatch-edit-province-saved')->to(ZipsPage::class);
    }
}
