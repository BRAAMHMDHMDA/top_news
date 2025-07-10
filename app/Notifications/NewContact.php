<?php

namespace App\Notifications;

use App\Filament\Resources\ContactResource;
use App\Models\Contact;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewContact extends Notification
{
    use Queueable;

    public Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return FilamentNotification::make()
            ->title('New Contact')
            ->warning()
            ->body($this->contact->email . " has sent you a contact")
            ->icon('heroicon-o-envelope')
            ->actions([
                Action::make('Go to contacts')
                    ->button()
                    ->url(ContactResource::getUrl('index', ['record' => $this->contact->id])) // adapt to your route
                    ->close(),
            ])
            ->getDatabaseMessage();
    }
}
