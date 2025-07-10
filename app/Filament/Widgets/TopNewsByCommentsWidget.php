<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopNewsByCommentsWidget extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'full';

    protected function getTableHeading(): ?string
    {
        return __('filament::top_news_by_comments');
    }


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
                ->label(__('filament::title')),

            TextColumn::make('comments_count')
                ->label(__('filament::comments')),

            TextColumn::make('created_at')
                ->since()
                ->label(__('filament::created_at'))
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
