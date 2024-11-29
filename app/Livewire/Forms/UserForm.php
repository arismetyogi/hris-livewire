<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    #[Locked]
    public $id;
    public
        $username,
        $first_name,
        $last_name,
        $email,
        $department_id = null,
        $password = '',
        $password_confirmation = '';

    public function rules(): array
    {
        return [
            'username' => ['required', 'min:6',
                Rule::unique('users')->ignore($this->user)
            ],
            'email' => ['required', 'min:6', 'email',
                Rule::unique('users')->ignore($this->user)
            ],
            'first_name' => ['required', 'min:3'],
            'last_name' => ['nullable', 'min:3'],
            'department_id' => ['nullable', 'numeric', 'exists:departments,id'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }

    public function setUser(?User $user = null): void
    {
        $this->user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->department_id = $user->department_id;
        $this->password = $user->password;
    }

    public function save(): void
    {
        $this->validate();
        if (!$this->user) {
            User::create($this->except(['user']));
        } else {
            $this->user->update($this->except(['user']));
        }
        $this->reset();
    }
}
