<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Models\Tag;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTags extends ManageRecords
{
    protected static string $resource = TagResource::class;

    public function getTitle(): string
    {
        return __('filament::tags');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('filament::create')),
            Actions\Action::make('delete_unused_tags')
                ->label(__('filament::delete_unused_tags'))
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->action(function () {
                    $deletedCount = Tag::doesntHave('news')->delete();
                    \Filament\Notifications\Notification::make()
                        ->title($deletedCount > 0
                            ? __('filament::deleted_count_unused_tags', ['count' => $deletedCount])
                            : __('filament::no_unused_tags_found'))
                        ->status($deletedCount > 0 ? 'success' : 'warning')
                        ->send();
                })
                ->requiresConfirmation()
                ->modalHeading(__('filament::delete_unused_tags'))
                ->modalDescription(__('filament::confirm_delete_unused_tags_description'))
                ->modalSubmitActionLabel(__('filament::yes_delete_them')),
        ];
    }
}
