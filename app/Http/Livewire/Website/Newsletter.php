<?php

namespace App\Http\Livewire\Website;

use App\Models\Subscriber;
use Illuminate\View\View;
use Livewire\Component;

class Newsletter extends Component
{
    public string $email;

    public function submit(): void
    {
        $this->validate([
            'email' => 'required|unique:subscribers|email',
        ],[
            'email.unique' => __('website.this_email_subscribed')
        ]);

        Subscriber::create(['email' => $this->email]);
        session()->flash('subscribe_success');
        $this->email = '';

    }

    public function render(): View
    {
        return view('website.sections.newsletter');
    }
}
