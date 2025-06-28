<?php

namespace App\View\Components\Website;

use App\Models\Ad;
use App\Models\News;
use App\Models\SocialCount;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public Collection $mostViewedNews, $tags, $social_counts;
    public $ad_sidebar;

    public function __construct()
    {
        $this->mostViewedNews = News::activeEntries()
            ->orderBy('views', 'desc')
            ->with('author')
            ->take(3)
            ->get();

        $this->tags = Tag::withCount('news')->get();

        $this->social_counts = SocialCount::active()->get();

        $this->ad_sidebar = Ad::where('position', Ad::SIDE_BAR)
            ->where('status', Ad::STATUS_ACTIVE)
            ->latest()
            ->first();
    }

    public function render(): View
    {
        return view('website.sections.sidebar');
    }
}
