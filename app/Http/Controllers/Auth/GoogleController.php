<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    // Redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $customer = Customer::where('email', $googleUser->getEmail())->first();

            if (!$customer) {
                $customer = Customer::create([
                    'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? $googleUser->getEmail(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(uniqid()), // Random password
                    'email_verified_at' => now(),
                ]);
            }

            Auth::guard('customer')->login($customer, true);
            return redirect()->intended('/profile');
        } catch (\Exception $e) {
            Log::error('Google Login Error: ' . $e->getMessage());
            Session::flash('error', 'Unable to login with Google.');
            return Redirect::route('login');
        }
    }
}
