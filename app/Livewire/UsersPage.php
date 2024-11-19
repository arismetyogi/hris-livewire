<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Users')]
// refresh page on save
#[On('dispatch-user.create-save')]
class UsersPage extends Component
{
    use WithPagination;

    public
    $search = '',
    $perPage = '5',
    $sortBy = 'users.updated_at',
    $sortDir = 'DESC',
    $confirmingUserDeletion = false,
    $confirmingUserAddition = false;
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

    public function confirmUserDeletion($id)
    {
        $this->confirmingUserDeletion = $id;
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        $this->confirmingUserDeletion = false;
    }
}
