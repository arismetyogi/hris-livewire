<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Users')]
class UsersPage extends Component
{
    use WithPagination;
    // public User $user; // shorthand for mount function

    public $search = '';
    public $perPage = '5';
    public $sortBy = 'users.updated_at';
    public $sortDir = 'ASC';
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function setSortBy($sortByCol)
    {
        if ($this->sortBy = $sortByCol) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
        }
        $this->sortBy = $sortByCol;
    }
    public function render()
    {
        $users = User::where(function ($query) {
            // Apply search conditions for first_name, last_name, and email
            $query
                ->orWhere('first_name', 'like', '%' . $this->search . '%')
                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%');
        })
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.users-page', [
            'users' => $users
        ]);
    }
}
