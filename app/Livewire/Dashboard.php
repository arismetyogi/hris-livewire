<?php

namespace App\Livewire;

use App\Models\Department;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', ['departments' => Department::latest()->get()]);
    }
}
