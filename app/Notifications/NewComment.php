<?php

namespace App\Notifications;

use App\Filament\Resources\CommentResource;
use App\Models\Comment;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Notifications\Notification;

class NewComment extends Notification
{
//    use Queueable;

    public Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return FilamentNotification::make()
            ->title('New Comment')
            ->warning()
            ->body("{$this->comment->customer->name} has commented on {$this->comment->news->title}")
            ->icon('heroicon-o-chat-bubble-left-right')
            ->actions([
                Action::make('Go to Comments')
                    ->button()
                    ->url(CommentResource::getUrl('index')) // adapt to your route
                    ->close(),
            ])
            ->getDatabaseMessage();
    }
}
