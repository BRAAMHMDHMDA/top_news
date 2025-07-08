<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasFactory, HasTranslations, HasImage;

    static string $DISK = 'public';
    static string $NAME_IMG_COL = 'image_path';

    public array $translatable = ['title', 'content', 'meta_title', 'meta_description'];
    protected $fillable = ['category_id', 'image_path', 'title', 'slug', 'content', 'meta_title', 'meta_description', 'is_breaking_news', 'show_at_slider', 'show_at_popular', 'status', 'is_approved', 'views'];
    protected $casts = [
        'show_at_slider' => 'boolean',
        'show_at_popular' => 'boolean',
        'is_breaking_news' => 'boolean',
        'status' => 'boolean',
        'is_approved' => 'boolean',
        'created_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($news) {
            // Only set author_id if not already set and there's an authenticated user
            if (empty($news->author_id) && Auth::guard('web')->check()) {
                $news->author_id = Auth::guard('web')->user()->id;
            }
            
            // Ensure we have a slug
            if (empty($news->slug) && !empty($news->title)) {
                $news->slug = Str::slug(is_array($news->title) ? $news->title['en'] : $news->title);
            }
        });
        
        static::saving(function ($news) {
            // Ensure we have a slug
            if (empty($news->slug) && !empty($news->title)) {
                $news->slug = Str::slug(is_array($news->title) ? $news->title['en'] : $news->title);
            }
        });
    }

    public function scopeActiveEntries($query)
    {
        return $query->where([
            'status' => 1,
            'is_approved' => 1
        ]);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)
            ->whereNull('parent_id')
            ->with('replies');
    }


    public function author(): BelongsTo
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
