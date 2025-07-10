<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdResource\Pages;
use App\Models\Ad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AdResource extends Resource
{
    protected static ?string $model = Ad::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('filament::ads');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament::general');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // select input position
                Forms\Components\Select::make('position')
                    ->label(__('filament::position'))
                    ->options([
                        Ad::HOME_TOP => Ad::HOME_TOP,
                        Ad::HOME_MIDDLE => Ad::HOME_MIDDLE,
                        Ad::NEWS_PAGE => Ad::NEWS_PAGE,
                        Ad::VIEW_PAGE => Ad::VIEW_PAGE,
                        Ad::SIDE_BAR => Ad::SIDE_BAR,
                    ])
                    ->required(),

                Forms\Components\TextInput::make('url')
                    ->label(__('filament::url'))
                    ->url()
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('image_path')
                    ->label(__('filament::image'))
                    ->image()
                    ->required(),

                // bool active or draft
                Forms\Components\Radio::make('status')
                    ->label(__('filament::status'))
                    ->options([
                        Ad::STATUS_ACTIVE => __('filament::statuses.active'),
                        Ad::STATUS_DRAFT => __('filament::statuses.draft'),
                    ])
                    ->inline()
                    ->inlineLabel(false)
                    ->default(Ad::STATUS_DRAFT)
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position')
                    ->label(__('filament::position'))
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label(__('filament::image')),

                Tables\Columns\TextColumn::make('url')
                    ->label(__('filament::url'))
                    ->searchable(),

                Tables\Columns\IconColumn::make('status')
                    ->label(__('filament::status'))
                    ->icon(fn(string $state): string => match ($state) {
                        Ad::STATUS_DRAFT => 'heroicon-o-archive-box-x-mark',
                        Ad::STATUS_ACTIVE => 'heroicon-o-check-badge',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        Ad::STATUS_DRAFT => 'warning',
                        Ad::STATUS_ACTIVE => 'success',
                    })
                    ->sortable()
                    ->searchable()
                ,
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
                    ->modalHeading(__('filament::edit_ad')),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('filament::delete_ad')),

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
            'index' => Pages\ManageAds::route('/'),
        ];
    }
}
