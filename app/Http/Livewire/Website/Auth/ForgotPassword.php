<?php

namespace App\Http\Livewire\Website\Auth;

use App\Http\Livewire\Website\Auth\Forms\ForgotPasswordForm;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Livewire\Component;

class ForgotPassword extends Component
{
    public ForgotPasswordForm $form;

    public function sendResetLink(): void
    {
        // Validate the form data
        $validated = $this->validate([
            'form.email' => ['required', 'email'],
        ]);
        
        $status = Password::broker('customers')->sendResetLink(
            ['email' => $this->form->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
            $this->reset('form.email');
        } else {
            $this->addError('form.email', __($status));
        }
    }

    public function render(): View
    {
        return view('website.auth.forgot-password')
            ->layout('website.layout.master', [
                'title' => __('website.forgot_password')
            ]);
    }
}
