<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'slug'];
    protected $fillable = ['name', 'slug', 'show_at_nav', 'status', 'created_at', 'updated_at'];


    protected $casts = [
        'show_at_nav' => 'boolean',
        'status' => 'boolean',
    ];

    // scope to filter categories that should be shown in navigation
    public function scopeShowAtNav($query)
    {
        return $query
            ->where('status', true)
            ->where('show_at_nav', true);
    }

    // scope to filter categories that are active
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function news(): HasMany
    {
        return $this->hasMany('App\Models\News');
    }
}
