<?php

namespace App\Livewire;

use App\Livewire\Forms\ProvinceForm;
use App\Models\Province;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Provinces')]
// refresh page on save
#[On('dispatch-create-province-saved')]
#[On('dispatch-edit-province-saved')]
class ProvincesPage extends Component
{
    use WithPagination;

    public ProvinceForm $form;

    public
        $search = '',
        $perPage = '5',
        $sortField = 'updated_at',
        $sortDirection = 'desc',
        $confirmingProvinceDeletion = false,
        $confirmingProvinceAddition = false,
        $editProvinceModal = false;

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
        $provinces = Province::where(function ($query) {
            // Apply search conditions for id and name
            $query
                ->orWhere('id', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.provinces-page', [
            'provinces' => $provinces
        ]);
    }

    public function confirmProvinceDeletion($id): void
    {
        $this->confirmingProvinceDeletion = $id;
    }

    public function deleteProvince(Province $province): void
    {
        $province->delete();
        $this->confirmingProvinceDeletion = false;
    }

    public function editProvince(Province $id): void
    {
        $this->form->setProvince($id);
        $this->editProvinceModal = true;
    }

    public function edit(): void
    {
        $this->validate();
        // panggil method store dari ProvinceForm
        $update = $this->form->update();
        is_null($update)
            ? $this->dispatch('notify', title: 'success', message: 'Province updated successfully!')
            : $this->dispatch('notify', title: 'failed', message: 'Failed to update province!');
        $this->dispatch('dispatch-edit-province-saved')->to(ProvincesPage::class);
    }
}
