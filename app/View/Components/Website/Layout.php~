<?php

namespace App\View\Components\Website;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public String $title;
    public $nav_categories;

    public function __construct(String $title)
    {
        $this->title = $title;
        $this->nav_categories = Category::showAtNav()->get();
    }

    public function render(): View|Closure|string
    {
        return view('website.layout.master');
    }
}
