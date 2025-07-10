<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\NewsResource;
use App\Models\News;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopNewsByViewsWidget extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    protected function getTableHeading(): ?string
    {
        return __('filament::top_news_by_views');
    }

    protected function getTableQuery(): Builder
    {
        return News::activeEntries()
            ->orderBy('views', 'desc')
            ->limit(5);
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')
                ->label(__('filament::title')),

            TextColumn::make('views')
                ->label(__('filament::views')),

            TextColumn::make('created_at')
                ->since()
                ->label(__('filament::created_at'))
                ->dateTimeTooltip() // shows the full timestamp in a tooltip,
        ];
    }

    protected function getTableRecordUrlUsing(): ?\Closure
    {
        return fn($record): ?string => NewsResource::getUrl('view', ['record' => $record]);
    }
}
