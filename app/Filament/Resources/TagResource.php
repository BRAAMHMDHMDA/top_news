<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Models\Tag;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
        protected static ?string $navigationGroup = 'News';
        // navigation Group first group


    protected static ?int $navigationSort = 2;


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('news_count')
                    ->label('News Count')
                    ->counts('news'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('View Linked News')
                    ->url(function ($record) {
                        return route('filament.admin.resources.news.index', ['tableFilters[tags][values][0]' => $record->id]);
                    }),
                ])
            ->bulkActions([
                //
            ]);
    }
    public static function canCreate(): bool
    {
        return false;
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name'),
                ViewEntry::make('news')
                    ->view('filament.resources.tag-resource.infolists.components.news-list'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTags::route('/'),

//            'index' => Pages\ListTags::route('/'),
//            'view' => Pages\ViewTag::route('/{record}'),
        ];
    }
}
