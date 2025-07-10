<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialCountResource\Pages;
use App\Models\SocialCount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class SocialCountResource extends Resource
{
    use Translatable;

    protected static ?string $model = SocialCount::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('filament::social_count');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament::general');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fan_type')
                    ->label(__('filament::fan_type'))
                    ->required()
                    ->placeholder('Subscribers, Likes, Views')
                    ->maxLength(255),

                Forms\Components\TextInput::make('button_text')
                    ->label(__('filament::button_text'))
                    ->required()
                    ->placeholder('Follow, Subscribe, Join, Like')
                    ->maxLength(255),

                Forms\Components\TextInput::make('icon')
                    ->label(__('filament::icon'))
                    ->required()
                    ->placeholder('fa fa-facebook')
                    ->maxLength(255),
                Forms\Components\TextInput::make('fan_count')
                    ->label(__('filament::fan_count'))
                    ->placeholder('100k')
                    ->required()
                    ->maxLength(255),

                Forms\Components\ColorPicker::make('color')
                    ->label(__('filament::color'))
                    ->required()
                    ->placeholder('#FF0000'),

                Forms\Components\ToggleButtons::make('status')
                    ->label(__('filament::is_active'))
                    ->boolean(__('filament::yes_active'), __('filament::no_active'))
                    ->default(true)
                    ->grouped(),
                Forms\Components\TextInput::make('url')
                    ->label(__('filament::url'))
                    ->url()
                    ->prefix('https://')
                    ->default('https://')
                    ->suffixIcon('heroicon-m-globe-alt')
                    ->required()
                    ->placeholder('www.facebook.com')
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // i need view this icon fa Font Awesome Icons

//                Tables\Columns\IconColumn::make('icon')
//                    ->label(__('filament::icon')),

                Tables\Columns\TextColumn::make('icon')
                    ->label(__('filament::icon'))
                    ->searchable()
                ,

                Tables\Columns\TextColumn::make('url')
                    ->label(__('filament::url'))
                    ->searchable()
                    ->url(function ($record) {
                        return $record->url;
                    })
                    ->openUrlInNewTab()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('fan_count')
                    ->label(__('filament::fan_count'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('fan_type')
                    ->label(__('filament::fan_type'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('button_text')
                    ->label(__('filament::button_text'))
                    ->searchable(),

                Tables\Columns\ColorColumn::make('color')
                    ->label(__('filament::color'))
                    ->copyable()
                    ->copyMessage('Color code copied')
                    ->copyMessageDuration(1500),

                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('filament::is_active')),

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
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading(__('filament::edit_socialCount')),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('filament::delete_socialCount')),

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
            'index' => Pages\ManageSocialCounts::route('/'),
        ];
    }
}
