<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user;

    #[Rule('required|unique:users|min:6', as: 'Username')]
    public $username;
    #[Rule('required|min:6', as: 'First Name')]
    public $first_name;
    #[Rule(as: 'Last Name')]
    public $last_name;
    #[Rule('required|email|unique:users', as: 'Email')]
    public $email;
    #[Rule('required|min:8', as: 'Password')]
    public $password;

    public function setUser(User $user)
    {
        $this->user = $user;

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->password = Hash::make($user->password);
    }
    public function store()
    {
        User::create($this->except(['user']));
        $this->reset();
    }

    public function update()
    {
        $this->user->update($this->except(['user']));
    }
}
