<?php

namespace App\Filament\Resources\SocialCountResource\Pages;

use App\Filament\Resources\SocialCountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ManageRecords;


class ManageSocialCounts extends ManageRecords
{
    protected static string $resource = SocialCountResource::class;
    use ListRecords\Concerns\Translatable;

    public function getTitle(): string
    {
        return __('filament::social_count');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalHeading(__('filament::create_socialCount'))
                ->label(__('filament::create_socialCount')),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
