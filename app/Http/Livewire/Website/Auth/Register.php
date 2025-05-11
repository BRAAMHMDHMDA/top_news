<?php

namespace App\Http\Livewire\Website\Auth;

use App\Models\Customer;
use App\Providers\RouteServiceProvider;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';


    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Customer::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        event(new Registered($customer = Customer::create($validated)));
        Auth::guard('customer')->login($customer);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function render(): View
    {
        return view('website.auth.register')
            ->layout('website.layout.master', [
                'title' =>  __('website.register')
            ]);

    }
}
