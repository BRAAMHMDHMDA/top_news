<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['email', 'subject', 'message', 'is_read', 'created_at', 'updated_at'];
    protected $casts = [
        'is_read' => 'boolean',
    ];
}
