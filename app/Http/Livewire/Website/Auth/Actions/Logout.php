<?php

namespace App\Http\Livewire\Website\Auth\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        Auth::guard('customer')->logout();
        Session::invalidate();
        Session::regenerateToken();
    }
}
