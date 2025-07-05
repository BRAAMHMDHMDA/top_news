<?php

namespace App\Http\Livewire\Website\Auth\Forms;

use Illuminate\Validation\Rules\Password;
use Livewire\Form;

class ResetPasswordForm extends Form
{
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' => ['required'],
        ];
    }
}
