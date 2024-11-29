<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

#[On('recordDeleted')]
class EmployeesPage extends Component
{
    public function render()
    {
        return view('livewire.employees-page');
    }
}
