<?php

namespace App\Models;

use App\Notifications\NewContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Contact extends Model
{
    protected $fillable = ['email', 'subject', 'message', 'is_read', 'created_at', 'updated_at'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::created(function ($contact) {
            $admins = User::permission('view_contact')->get();
            Notification::send($admins, new NewContact($contact));
        });
    }
}
