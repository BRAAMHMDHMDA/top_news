<?php

namespace App\Filament\Resources\SubscriberResource\Pages;

use App\Filament\Resources\SubscriberResource;
use App\Mail\Newsletter;
use App\Models\Subscriber;
use Filament\Actions;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\Mail;

class ManageSubscribers extends ManageRecords
{
    protected static string $resource = SubscriberResource::class;

    public function getTitle(): string
    {
        return __('filament::subscribers');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('filament::add_subscriber'))
                ->modalHeading(__('filament::add_subscriber'))
                ->modalWidth(MaxWidth::MaxContent)
            ,
            Actions\Action::make('sendEmail')
                ->label(__('filament::send_newsletter'))
                ->modalHeading(__('filament::send_newsletter'))
                ->form([
                    Forms\Components\TextInput::make('subject')
                        ->label(__('filament::subject'))
                        ->required()
                        ->maxLength(255),
                    TiptapEditor::make('content')
                        ->label(__('filament::content'))
                        ->profile('default') // Use a predefined profile or customize as needed
                        ->required(),
                ])
                ->action(function (array $data) {
                    $subscribers = Subscriber::pluck('email')->toArray();
                    Mail::to($subscribers)->send(new Newsletter($data['subject'], $data['content']));
                    Notification::make()
                        ->success()
                        ->title(__('newsletter_sent'))
                        ->send();
                })
                ->color('warning')
                ->modalHeading(__('filament::send_newsletter'))
                ->modalDescription('null')
                ->icon('heroicon-m-envelope')
                ->requiresConfirmation()
                ->closeModalByClickingAway(false)
                ->modalWidth(MaxWidth::MaxContent)

            , // Set your desired width here

        ];
    }
}
