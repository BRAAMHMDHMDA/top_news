<?php

namespace App\Http\Livewire\Website;

use Livewire\Component;

class About extends Component
{
    public $content;

    public function mount(): void
    {
        $this->content = \App\Models\About::first()->content;
    }

    public function render()
    {
        return view('website.pages.about')
            ->layout('website.layout.master', [
                'title' => __('website.about-us')
            ]);
    }
}
