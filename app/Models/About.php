<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasTranslations;

    public array $translatable = ['content'];
    protected $table = 'about';
    protected $fillable = ['content'];
    protected $casts = ['content' => 'array'];

//    public static function boot(): void
//    {
//        parent::boot();
//        static::saved(function () {
//            cache()->forget('about');
//        });
//    }
//
//    public static function getData()
//    {
//        return cache()->rememberForever('about', function () {
//            return self::first();
//        });
//    }

}
