<?php

namespace App\Models;

use App\Filament\Resources\SubscriberResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'created_at', 'updated_at'];

    protected static function booted(): void
    {
        static::created(function ($subscriber) {
            // Notify all admin users
            $admins = \App\Models\User::role('super_admin')->get();
            Notification::make()
                ->title('New Subscriber')
                ->warning()
                ->body("{$subscriber->email} has Subscribed to our newsletter")
                ->icon('heroicon-o-newspaper')
                ->actions([
                    Action::make('Go to Subscribers')
                        ->button()
                        ->url(SubscriberResource::getUrl('index')) // adapt to your route
                        ->close(),
                ])
                ->sendToDatabase($admins);
        });
    }
}
