<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Users')]
class UsersPage extends Component
{
    public User $user; // shorthand for mount function

    public function render()
    {
        return view('livewire.users-page');
    }
}
