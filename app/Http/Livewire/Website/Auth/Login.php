<?php

namespace App\Http\Livewire\Website\Auth;

use App\Http\Livewire\Website\Auth\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();

        $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
    }

    public function render(): View
    {
        return view('website.auth.login')
            ->layout('website.layout.master', [
                'title' =>  __('website.login')
            ]);
    }
}
