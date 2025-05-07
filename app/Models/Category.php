<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public array $translatable = ['name', 'slug'];
    protected $fillable = ['name', 'slug', 'show_at_nav', 'status', 'created_at', 'updated_at'];


    public function news(): HasMany
    {
        return $this->hasMany('App\Models\News');
    }
}
