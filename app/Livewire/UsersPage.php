<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Users')]
class UsersPage extends Component
{
    public function render()
    {
        return view('livewire.users-page');
    }
}
