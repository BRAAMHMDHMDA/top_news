<?php

namespace App\Filament\Resources\AdResource\Pages;

use App\Filament\Resources\AdResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAds extends ManageRecords
{
    protected static string $resource = AdResource::class;

    public function getTitle(): string
    {
        return __('filament::ads');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('filament::create_ad'))
                ->modalHeading(__('filament::create_ad')),
        ];
    }
}
