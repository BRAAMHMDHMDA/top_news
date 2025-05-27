<?php

namespace App\View\Components\Website;

use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecentNews extends Component
{
    public $news;

    public function __construct()
    {
        $this->news = News::with(['category'])
            ->activeEntries()
            ->with('author')
            ->latest()
            ->take(6)
            ->get();
    }

    public function render(): View
    {
        return view('website.sections.recent-news');
    }
}
