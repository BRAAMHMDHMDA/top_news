<?php

namespace App\Http\Livewire\Website;

use App\Models\Contact as ContactModel;
use Livewire\Component;

class Contact extends Component
{
    public $email, $subject, $message;
    protected $rules = [
        'email' => 'required|email',
        'subject' => 'required|string|min:3',
        'message' => 'required|string|min:10',
    ];

    public function submit(): void
    {
        $this->validate();
        ContactModel::create([
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);
        $this->reset();
        session()->flash('contact_success');
    }

    public function render()
    {
        return view('website.pages.contact')
            ->layout('website.layout.master', [
                'title' => __('website.contact-us')
            ]);
    }
}
