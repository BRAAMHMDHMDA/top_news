<?php

namespace App\Models;

use App\Notifications\NewSubscriber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Subscriber extends Model
{
    protected $fillable = ['email', 'created_at', 'updated_at'];

    protected static function booted(): void
    {
        static::created(function ($subscriber) {
            $admins = User::permission('view_subscriber')->get();
            Notification::send($admins, new NewSubscriber($subscriber));
        });
    }
}
