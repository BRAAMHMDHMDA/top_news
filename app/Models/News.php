<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'slug', 'content', 'meta_title', 'meta_description'];
    protected $fillable = ['category_id', 'image_path', 'title', 'slug', 'content', 'meta_title', 'meta_description', 'is_breaking_news', 'show_at_slider', 'show_at_popular', 'status', 'is_approved', 'views'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($news) {
            $news->author_id = Auth::guard('web')->user()->id;
            $news->slug = Str::slug($news->title);
        });
    }
    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\Tag', 'news_tag');
    }
}
