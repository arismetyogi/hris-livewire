<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    #[Locked]
    public $id;
//    #[Validate('required|unique:users,username,' . $id . '|min:6', as: 'Username')]
    public $username;
//    #[Validate('required|min:6', as: 'First Name')]
    public $first_name;
//    #[Validate(as: 'Last Name')]
    public $last_name;
//    #[Validate('required|email|unique:users,email,' . $id . '|min:6', as: 'Email')]
    public $email;
//    #[Validate('required', as: 'Department')]
    public $department_id="";
//    #[Validate('required|min:8', as: 'Password')]
    public $password="";
    public $password_confirmation="";

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

    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->department_id = $user->department_id;
        $this->password = $user->password;
    }

    public function store(): void
    {
        User::create($this->except(['user']));
        $this->reset();
    }

    public function update(): void
    {
        $this->user->update($this->except(['user']));
    }
}
