<?php

namespace App\View\Components\Website;

use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroSlider extends Component
{
    public $heroSlider;
    public function __construct()
    {
        $this->heroSlider = News::with(['category', 'author'])
            ->activeEntries()
            ->with('author')
            ->where('show_at_slider', 1)
            ->orderBy('id', 'DESC')->take(7)
            ->get();
    }

    public function render(): View
    {
        return view('website.sections.hero-slider');
    }
}
