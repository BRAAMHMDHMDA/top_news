<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\NewsResource;
use App\Models\Tag;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopTagsWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    protected int|string|array $columnSpan = '1/2';


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
                ->label('Tag'),
            TextColumn::make('news_count')
                ->label('Usage Count'),
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
