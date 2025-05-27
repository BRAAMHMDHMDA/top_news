<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SocialSettings extends Settings
{
    public ?string $facebook_link;
    public ?string $twitter_link;
    public ?string $telegram_link;
    public ?string $whatsapp_link;
    public ?string $linkedin_link;


    public static function group(): string
    {
        return 'social';
    }
}
