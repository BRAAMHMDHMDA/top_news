<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\NewsResource;
use App\Models\Tag;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopTagsWidget extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 5;
    protected int|string|array $columnSpan = '1/2';

    protected function getTableHeading(): ?string
    {
        return __('filament::top_tags');
    }

    protected function getTableQuery(): Builder
    {
        return Tag::query()
            ->withCount('news')
            ->orderBy('news_count', 'desc')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label(__('filament::tag')),
            TextColumn::make('news_count')
                ->label(__('filament::usage_count')),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableRecordUrlUsing(): ?\Closure
    {
        return fn($record): ?string => NewsResource::getUrl('index', [
            'tableFilters[tags][values][0]' => $record->id,
        ]);
    }
}
