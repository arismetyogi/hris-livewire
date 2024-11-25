<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    #[Validate('required|unique:users|min:6', as: 'Username')]
    public $username;
    #[Validate('required|min:6', as: 'First Name')]
    public $first_name;
    #[Validate(as: 'Last Name')]
    public $last_name;
    #[Validate('required|email|unique:users', as: 'Email')]
    public $email;
    #[Validate('required', as: 'Department')]
    public $department_id;
    #[Validate('required|min:8', as: 'Password')]
    public $password;

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
