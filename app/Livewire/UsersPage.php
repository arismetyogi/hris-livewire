<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use App\Traits\WithSorting;
use Illuminate\View\View;
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

    public UserForm $form;

    public
        $search = '',
        $perPage = '5',
        $sortBy = 'users.updated_at',
        $sortDir = 'DESC',
        $confirmingUserDeletion = false,
        $confirmingUserAddition = false,
        $editUserModal = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function setSortBy($sortByCol): void
    {
        if ($this->sortBy = $sortByCol) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
        }
        $this->sortBy = $sortByCol;
    }

    public function render(): View
    {
        $users = User::with('department')->where(function ($query) {
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

    public function confirmUserDeletion($id): void
    {
        $this->confirmingUserDeletion = $id;
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
        $this->confirmingUserDeletion = false;
    }

    public function editUser(User $id): void
    {
        $this->form->setUser($id);
        $this->form->password = '';
        $this->form->password_confirmation = '';
        $this->editUserModal = true;
    }

    public function edit(): void
    {
        $this->validate();
        // panggil method store dari UserForm
        $update = $this->form->update();
        is_null($update)
            ? $this->dispatch('notify', title: 'success', message: 'User updated successfully!')
            : $this->dispatch('notify', title: 'failed', message: 'Failed to update user!');
        $this->dispatch('dispatch-edit-department-saved')->to(UsersPage::class);

        $this->editUserModal = false;
    }
}
