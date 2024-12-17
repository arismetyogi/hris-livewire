<?php

namespace App\Livewire\Payroll;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Payroll')]
#[On('refresh-payroll-list')]
#[On('recordDeleted')]
#[Layout('layouts.admin')]
class Index extends Component
{
    public function render(): View
    {
        return view('livewire.payroll.index', []);
    }
}
