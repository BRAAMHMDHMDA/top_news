<?php

namespace App\View\Components\Website;

use App\Models\Category;
use App\Models\News;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SliderNews extends Component
{
    public $news;
    public $category_name;

    public function __construct(int $section)
    {
        $categoryId = $this->resolveCategoryId($section);
        $this->category_name = Category::find($categoryId)->name;
        $this->news = $this->fetchNewsItems($categoryId);
    }

    protected function resolveCategoryId(int $section): int
    {
        $mapping = [
            1 => 'home.category_section_one',
            2 => 'home.category_section_two',
        ];

        if (!array_key_exists($section, $mapping)) {
            throw new NotFoundHttpException('Invalid section specified.');
        }

        return setting($mapping[$section]);
    }

    protected function fetchNewsItems(int $categoryId)
    {
        return News::where('category_id', $categoryId)
            ->activeEntries()
            ->with('author')
            ->latest()
            ->limit(8)
            ->get();
    }


    public function render(): View
    {
        return view('website.sections.slider-news');
    }
}
