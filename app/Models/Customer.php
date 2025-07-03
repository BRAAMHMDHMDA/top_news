<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Customer extends Authenticatable
{
    use HasImage;

    static string $DISK = 'public';
    static string $NAME_IMG_COL = 'image_path';

    protected $fillable = [
        'name',
        'email',
        'password',
        'image_path',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }
}
