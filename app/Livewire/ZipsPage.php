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
#[On('refresh-zip-list')]
class ZipsPage extends Component
{
    use WithPagination;

    public ZipForm $form;

    public
        $search = '',
        $perPage = '5',
        $sortField = 'provinces.name',
        $sortDirection = 'asc',
        $confirmingZipDeletion = false;

    protected $queryString = ['search', 'sortField', 'sortDirection'];

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
        $zips = Zip::with('province')
            ->select('zips.*', 'provinces.name as province_name', 'provinces.name_en as province_name_en', 'provinces.code as province_code')
            ->leftJoin('provinces', 'zips.province_code', '=', 'provinces.code')
            ->where(function ($query) {
                // Apply search conditions for id and name
                $query
                    ->orWhere('provinces.name', 'like', '%' . $this->search . '%')
                    ->orWhere('provinces.name_en', 'like', '%' . $this->search . '%')
                    ->orWhere('urban', 'like', '%' . $this->search . '%')
                    ->orWhere('subdistrict', 'like', '%' . $this->search . '%')
                    ->orWhere('city', 'like', '%' . $this->search . '%')
                    ->orWhere('zipcode', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.zips-page', [
            'zips' => $zips
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
    
}
