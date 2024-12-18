<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Greeting extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.greeting');
    }
}
