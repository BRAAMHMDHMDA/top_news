<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('social.facebook_link', null);
        $this->migrator->add('social.twitter_link', null);
        $this->migrator->add('social.telegram_link', null);
        $this->migrator->add('social.whatsapp_link', null);
        $this->migrator->add('social.linkedin_link', null);
    }
};
