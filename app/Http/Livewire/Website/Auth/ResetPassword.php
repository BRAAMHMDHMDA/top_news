<?php

namespace App\Http\Livewire\Website\Auth;

use App\Http\Livewire\Website\Auth\Forms\ResetPasswordForm;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class ResetPassword extends Component
{
    public ResetPasswordForm $form;
    public string $token;
    public string $email;

    public function mount($token, $email): void
    {
        $this->token = $token;
        $this->email = $email;
        $this->form->email = $email;
    }

    public function resetPassword(): void
    {
        // Validate the form data
        $validated = $this->validate([
            'form.email' => ['required', 'email'],
            'form.password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'form.password_confirmation' => ['required'],
        ]);

        $status = Password::broker('customers')->reset(
            [
                'email' => $this->email,
                'password' => $this->form->password,
                'password_confirmation' => $this->form->password_confirmation,
                'token' => $this->token
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('status', __($status));
            $this->redirectRoute('login');
        } else {
            $this->addError('form.email', __($status));
        }
    }

    public function render(): View
    {
        return view('website.auth.reset-password')
            ->layout('website.layout.master', [
                'title' => __('website.reset_password')
            ]);
    }
}
