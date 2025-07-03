<?php

namespace App\Http\Livewire\Website;

use App\Models\Ad;
use App\Models\Comment;
use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class ShowNews extends Component
{
    use WithPagination;

    public $news, $nextPost, $previousPost, $relatedPosts;
    public $comment, $parent_id;
    public $ad_view_page;

    public function mount($slug): void
    {
        $this->ad_view_page = Ad::where('position', Ad::VIEW_PAGE)
            ->where('status', Ad::STATUS_ACTIVE)
            ->latest()
            ->first();

        $this->news = News::activeEntries()
            ->where('slug', $slug)
            ->with(['category', 'author', 'tags'])
            ->firstOrFail();

        $this->countView();

        $this->nextPost = News::where('id', '>', $this->news->id)
            ->activeEntries()
//            ->where('category_id', $this->news->category_id)
            ->orderBy('id', 'asc')
            ->first();

        $this->previousPost = News::where('id', '<', $this->news->id)
            ->activeEntries()
//            ->where('category_id', $this->news->category_id)
            ->orderBy('id', 'desc')
            ->first();

        $this->relatedPosts = News::where('slug', '!=', $this->news->slug)
            ->where('category_id', $this->news->category_id)
            ->activeEntries()
            ->inRandomOrder()
            ->take(5)
            ->get();
    }

    private function countView(): void
    {
        if (session()->has('viewed_posts')) {
            $postIds = session('viewed_posts');
            if (!in_array($this->news->id, $postIds)) {
                $postIds[] = $this->news->id;
                $this->news->increment('views');
            }
            session(['viewed_posts' => $postIds]);

        } else {
            session(['viewed_posts' => [$this->news->id]]);
            $this->news->increment('views');
        }
    }

    public function getCommentsProperty()
    {
        return $this->news->comments()
            ->with('customer')
            ->latest()
            ->paginate(5);
    }

    public function submit(): void
    {
        $this->validate(['comment' => 'required|string|max:255']);

        $comment = $this->news->comments()->create([
            'customer_id' => auth()->guard('customer')->user()->id,
            'news_id' => $this->news->id,
            'comment' => $this->comment,
            'parent_id' => $this->parent_id
        ]);

        // Load the customer relationship for the new comment
        $comment->load('customer');

        //after comment added close modal
        $this->dispatch('closeModal');

        $this->comment = null;
        $this->parent_id = null;

        // Reset pagination to first page to show the new comment
        $this->resetPage();

        session()->flash('success', __('website.comment_added'));
    }

    public function deleteComment($id): void
    {
        $comment = Comment::findOrFail($id)->delete();

        // delete $comment deleted form comments collection
//        $this->comment->where('id', $id)->each(function ($comment) {
//            $comment->delete();
//        });

        session()->flash('success', __('website.comment_deleted'));
    }

    public function render()
    {
        return view('website.pages.show-news')
            ->layout('website.layout.master', [
                'title' => __('website.news')
            ]);
    }
}
