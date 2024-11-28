<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Users')]
// refresh page on save
#[On('dispatch-create-user-saved')]
#[On('dispatch-edit-user-saved')]
class UsersPage extends Component
{
    use WithPagination;

    public UserForm $form;

    public
        $search = '',
        $perPage = '5',
        $sortField = 'users.updated_at',
        $sortDirection = 'desc',
        $confirmingUserDeletion = false,
        $confirmingUserAddition = false,
        $editUserModal = false;

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
        $users = User::with('department')
            ->select('users.*', 'departments.name as department_name')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->where(function ($query) {
                // Apply search conditions for first_name, last_name, and email
                $query
                    ->orWhere('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
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

    public function getSessionsProperty()
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            return (object)[
                'user_id' => $session->user_id,
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === request()->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                'last_activity' => $session->last_activity,
            ];
        });
    }

    public function edit(): void
    {
        $this->validate();
        // panggil method store dari UserForm
        $update = $this->form->update();
        is_null($update)
            ? $this->dispatch('notify', title: 'success', message: 'User updated successfully!')
            : $this->dispatch('notify', title: 'failed', message: 'Failed to update user!');
        $this->dispatch('dispatch-edit-user-saved')->to(UsersPage::class);

        $this->editUserModal = false;
    }
}
