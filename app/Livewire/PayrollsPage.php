<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

#[On('recordDeleted')]
class PayrollsPage extends Component
{
    public function render()
    {
        return view('livewire.payrolls-page');
    }
}
