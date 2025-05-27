<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasImage
{
    public static function bootHasImage(): void
    {
        static::retrieved(function ($model) {
            $model->append('image_url');
        });
    }

    public function getImageUrlAttribute(): string
    {
        // Determine column key and its value
        $column = static::$NAME_IMG_COL ?? 'image_path';
        $value = data_get($this, $column);

        // No image provided: return a placeholder
        if (empty($value)) {
            return asset('storage/media/no-image.png');
        }

        // If already a full URL, return it directly
        if (Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        // Otherwise, assume it's a storage path and build a URL
        $disk = static::$DISK ?? config('filesystems.default');
        return Storage::disk($disk)->url($value);
    }
}
