<?php

namespace App\Models;

use App\Filament\Resources\CommentResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    protected $fillable = ['news_id', 'parent_id', 'comment', 'status'];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($comment) {
            $comment->customer_id = Auth::guard('customer')->user()->id;
        });

        static::created(function ($comment) {
            $admins = \App\Models\User::role('super_admin')->get();
            Notification::make()
                ->title('New Comment')
                ->warning()
                ->body("{$comment->customer->name} has commented on {$comment->news->title}")
                ->icon('heroicon-o-chat-bubble-left-right')
                ->actions([
                    Action::make('Go to Comments')
                        ->button()
                        ->url(CommentResource::getUrl('index')) // adapt to your route
                        ->close(),
                ])
                ->sendToDatabase($admins);
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function news(): BelongsTo
    {
        return $this->belongsTo('App\Models\News');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        // here we only fetch comments whose parent_id == this comment's id
        return $this->hasMany(self::class, 'parent_id');
    }
}
