<?php

namespace App\View\Components\Website;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public String $title;

    public function __construct(String $title)
    {
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('website.layout.master');
    }
}
