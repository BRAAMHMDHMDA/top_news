<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function news(): BelongsToMany
    {
        return $this->belongsToMany('App\Models\News');
    }
}
