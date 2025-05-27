<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SocialCount extends Model
{
    use HasTranslations;

    protected $fillable = ['icon', 'fan_count', 'fan_type', 'button_text', 'color', 'url', 'status'];
    public array $translatable = ['fan_type', 'button_text'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }


}
