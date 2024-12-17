<?php

namespace App\Livewire\Employee;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Employees')]
#[On('refresh-user-list')]
#[On('recordDeleted')]
#[Layout('layouts.admin')]
class Index extends Component
{
    public function render(): View
    {
        return view('livewire.employee.index', []);
    }
}
