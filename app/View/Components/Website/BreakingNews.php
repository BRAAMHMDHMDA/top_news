<?php

namespace App\View\Components\Website;

use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreakingNews extends Component
{
    public $breakingNews;

    public function __construct()
    {
        $this->breakingNews = News::with('author')
            ->where(['is_breaking_news' => 1,])
            ->activeEntries()
            ->orderBy('id', 'DESC')->take(10)
            ->get();
    }


    public function render(): View
    {
        return view('website.sections.breaking-news');
    }
}
