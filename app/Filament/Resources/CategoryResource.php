<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('filament::categories');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament::news');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('filament::name'))
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true) // Trigger update on blur
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        // Only update slug if it hasn't been manually changed
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }

                        $set('slug', Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->label(__('filament::slug'))
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->readonly()
                    ->dehydrated(true),
                Forms\Components\Toggle::make('show_at_nav')
                    ->label(__('filament::show_in_navigation'))
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label(__('filament::status'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament::name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament::slug'))
                    ->searchable(),
                TextColumn::make('news_count')
                    ->label(__('filament::news_count'))
                    ->counts('news')
                    ->url(function ($record) {
                        return NewsResource::getUrl('index', [
                            'tableFilters[category][value]' => $record->id,
                        ]);
                    })
                    ->tooltip(__('filament::view_news_articles')),

                Tables\Columns\IconColumn::make('show_at_nav')
                    ->label(__('filament::show_in_navigation'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('status')
                    ->label(__('filament::status'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament::created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament::updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //show at nav
                Tables\Filters\SelectFilter::make('show_at_nav')
                    ->label(__('filament::show_in_navigation'))
                    ->options([
                        '1' => __('filament::shown_in_navigation'),
                        '0' => __('filament::not_shown_in_navigation'),
                    ])
                    ->placeholder(__('filament::all')),
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('filament::status'))
                    ->options([
                        '1' => __('filament::active'),
                        '0' => __('filament::inactive'),
                    ])
                    ->placeholder(__('filament::all')),

            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(__('filament::edit_category')),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('filament::delete_category')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategories::route('/'),
        ];
    }
}
