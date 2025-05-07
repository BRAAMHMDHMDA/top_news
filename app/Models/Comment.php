<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

    protected $fillable = ['news_id', 'parent_id', 'comment', 'status'];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($news) {
            $news->customer_id = Auth::guard('customer')->user()->id;
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer');
    }


    public function news(): BelongsTo
    {
        return $this->belongsTo('App\Models\News');
    }


    public function parent(): BelongsTo
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    }
}
