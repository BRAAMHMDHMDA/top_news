<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopNewsByCommentsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return News::activeEntries()
            ->withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')
                ->label('Title'),

            TextColumn::make('comments_count')
                ->label('Comments'),

            TextColumn::make('created_at')
                ->since()
                ->dateTimeTooltip() // shows the full timestamp in a tooltip,
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableRecordUrlUsing(): ?\Closure
    {
        return fn($record): ?string => NewsResource::getUrl('view', ['record' => $record]);
    }
}
