<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNews extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = NewsResource::class;

    public function getTitle(): string
    {
        return __('filament::news');
    }
    

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('filament::create_news')),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
