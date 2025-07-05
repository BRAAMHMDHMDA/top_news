<?php

namespace App\Http\Livewire\Website\Auth\Forms;

use Livewire\Form;

class ForgotPasswordForm extends Form
{
    public string $email = '';

    public function rules()
    {
        return [
            'email' => ['required', 'email'],
        ];
    }
}
