<?php

namespace App\Models;

use App\Filament\Resources\ContactResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['email', 'subject', 'message', 'is_read', 'created_at', 'updated_at'];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::created(function ($contact) {
            $admins = \App\Models\User::role('super_admin')->get();
            Notification::make()
                ->title('New Contact')
                ->warning()
                ->body("{$contact->email} has sent you a contact")
                ->icon('heroicon-o-envelope')
                ->actions([
                    Action::make('Go to contacts')
                        ->button()
                        ->url(ContactResource::getUrl('index', ['record' => $contact->id])) // adapt to your route
                        ->close(),
                ])
                ->sendToDatabase($admins);
        });
    }
}
