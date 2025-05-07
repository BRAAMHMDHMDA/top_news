<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Models\Tag;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTags extends ManageRecords
{
    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('delete_unused_tags')
                ->label('Delete Unused Tags')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->action(function () {
                    $deletedCount = Tag::doesntHave('news')->delete();
                    \Filament\Notifications\Notification::make()
                        ->title($deletedCount > 0 ? "Deleted {$deletedCount} unused tags." : 'No unused tags found.')
                        ->status($deletedCount > 0 ? 'success' : 'warning')
                        ->send();
                })
                ->requiresConfirmation()
                ->modalHeading('Delete Unused Tags')
                ->modalDescription('Are you sure you want to delete all tags not associated with any news? This cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete them'),
        ];
    }
}
