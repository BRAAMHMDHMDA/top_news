<?php

namespace App\Http\Livewire\Website;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ListNews extends Component
{
    use WithPagination;

    public Collection $categories;
    #[Url(except: '')]
    public $search, $category_id;


    public function mount(): void
    {
        $this->categories = Category::active()->latest()->get();
    }

    private function getNews()
    {
        return News::activeEntries()
            ->whereHas('category', function ($query) {
                $query->where('status', true);
            })
            ->when($this->category_id, function ($query) {
                $query->where('category_id', $this->category_id);
            })
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(6);
    }

    public function render(): View
    {
        return view('website.pages.list-news' ,[
                'news' => $this->getNews(),
            ])->layout('website.layout.master', [
            'title' => __('website.news')

        ]);
    }
}
