<?php

namespace App\View\Components\Website;

use App\Models\News;
use App\Models\SocialCount;
use App\Models\Tag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public Collection $mostViewedNews, $tags, $social_counts;

    public function __construct()
    {
        $this->mostViewedNews = News::activeEntries()
            ->orderBy('views', 'desc')
            ->with('author')
            ->take(3)
            ->get();

        $this->tags = Tag::withCount('news')->get();

        $this->social_counts = SocialCount::active()->get();
    }

    public function render(): View
    {
        return view('website.sections.sidebar');
    }
}
