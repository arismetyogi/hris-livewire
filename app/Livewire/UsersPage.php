<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $sortField = 'users.updated_at',
        $sortDirection = 'desc',
        $confirmingUserDeletion = false,
        $confirmingUserAddition = false,
        $editUserModal = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function sortBy($field): void
    {
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        $this->sortField = $field;
    }

    public function render(): View
    {
        $users = User::with('department')
            ->leftJoin('departments', 'users.department_id', '=', 'departments.id')
            ->where(function ($query) {
                // Apply search conditions for first_name, last_name, and email
                $query
                    ->orWhere('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->select('users.*', 'departments.name as department_name')
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
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            return (object)[
                'user_id' => $session->user_id,
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === request()->session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    public function getStatusColorAttribute($userId): string
    {
        return $this->isOnline($userId) ? 'green' : 'orange';
    }

    public function isOnline($userId): bool
    {
        $session = $this->sessions->firstWhere('user_id', $userId);

        // If no session is found, the user is offline
        if (!$session) {
            return false;
        }

        // Check if the last_active timestamp is within the last X minutes (e.g., 5 minutes)
        $lastActive = $session->last_active ? $session->last_active : null;
        $threshold = Carbon::now()->addMinutes(1); // 1 minutes threshold

        return $lastActive >= $threshold;
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
