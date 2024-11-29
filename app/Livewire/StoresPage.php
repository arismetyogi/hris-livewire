<?php

namespace App\Livewire;

use App\Models\Store;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("Stores")]
#[On('refresh-store-list')]
#[On('recordDeleted')]
class StoresPage extends Component
{
    use WithPagination;

    public
        $search = '',
        $perPage = '5',
        $sortField = 'stores.outlet_sap_id',
        $sortDirection = 'asc',
        $confirmingStoreDeletion = false;

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
        $stores = Store::with('department')
            ->select('stores.*', 'departments.name as department_name')
            ->leftJoin('departments', 'stores.department_id', '=', 'departments.id')
            ->where(function ($query) {
                // Apply search conditions for first_name, last_name, and email
                $query
                    ->orWhere('stores.outlet_sap_id', 'like', '%' . $this->search . '%')
                    ->orWhere('stores.name', 'like', '%' . $this->search . '%')
                    ->orWhere('departments.name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.stores-page', [
            'stores' => $stores
        ]);
    }

    public function confirmStoreDeletion($id): void
    {
        $this->confirmingStoreDeletion = $id;
    }

    public function deleteStore(Store $store): void
    {
        $store->delete();
        $this->confirmingStoreDeletion = false;
    }

}
