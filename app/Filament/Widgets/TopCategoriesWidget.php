<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\NewsResource;
use App\Models\Category;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopCategoriesWidget extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = '1/2';

    public static function getSort(): int
    {
        return 4;
    }

    protected function getTableQuery(): Builder
    {
        return Category::query()
            ->withCount('news')
            ->orderBy('news_count', 'desc')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')
                ->label('Category'),

            TextColumn::make('news_count')
                ->label('Number of News'),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableRecordUrlUsing(): ?\Closure
    {
        return fn($record): ?string => NewsResource::getUrl('index', [
            'tableFilters[category][value]' => $record->id,
        ]);
    }
}
