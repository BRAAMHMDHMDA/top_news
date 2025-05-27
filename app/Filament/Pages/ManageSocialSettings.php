<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageSocialSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = \App\Settings\SocialSettings::class;
    protected static bool $shouldRegisterNavigation = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               // facebook link
                TextInput::make('facebook_link')
                    ->label('Facebook Link')
                    ->placeholder('https://www.facebook.com/yourpage')
                    ->url()
                    ->required(),

                // twitter link
                TextInput::make('twitter_link')
                    ->label('Twitter Link')
                    ->placeholder('https://www.twitter.com/yourpage')
                    ->url()
                    ->required(),

                // telegram link
                TextInput::make('telegram_link')
                    ->label('Telegram Link')
                    ->placeholder('https://t.me/yourchannel')
                    ->url()
                    ->required(),

                // whatsapp link
                TextInput::make('whatsapp_link')
                    ->label('WhatsApp Link')
                    ->placeholder('https://wa.me/1234567890')
                    ->url()
                    ->required(),

                // linkedin link
                TextInput::make('linkedin_link')
                    ->label('LinkedIn Link')
                    ->placeholder('https://www.linkedin.com/in/yourprofile/')
                    ->url()
                    ->required(),
            ]);
    }
}
