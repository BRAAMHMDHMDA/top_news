<?php

namespace App\Notifications;

use App\Filament\Resources\SubscriberResource;
use App\Models\Subscriber;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewSubscriber extends Notification
{
    use Queueable;

    public Subscriber $subscriber;

    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return FilamentNotification::make()
            ->title('New Subscriber')
            ->warning()
            ->body("{$this->subscriber->email} has Subscribed to our newsletter")
            ->icon('heroicon-o-newspaper')
            ->actions([
                Action::make('Go to Subscribers')
                    ->button()
                    ->url(SubscriberResource::getUrl('index')) // adapt to your route
                    ->close(),
            ])
            ->getDatabaseMessage();
    }

}
