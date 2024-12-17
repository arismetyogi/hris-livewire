<?php

namespace App\Livewire\Actions;

use Livewire\Component;

class Logout extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        \Auth::guard('web')->logout();

        \Session::invalidate();
        \Session::regenerateToken();
    }
}
