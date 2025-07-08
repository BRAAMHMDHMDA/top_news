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
    protected static ?string $navigationGroup = 'General';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // select input position
                Forms\Components\Select::make('position')
                    ->options([
                        Ad::HOME_TOP => ucwords(str_replace('_', ' ', Ad::HOME_TOP)),
                        Ad::HOME_MIDDLE => ucwords(str_replace('_', ' ', Ad::HOME_MIDDLE)),
                        Ad::NEWS_PAGE => ucwords(str_replace('_', ' ', Ad::NEWS_PAGE)),
                        Ad::VIEW_PAGE => ucwords(str_replace('_', ' ', Ad::VIEW_PAGE)),
                        Ad::SIDE_BAR => ucwords(str_replace('_', ' ', Ad::SIDE_BAR)),
                    ])
                    ->required(),

                Forms\Components\TextInput::make('url')
                    ->url()
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->required(),

                // bool active or draft
                Forms\Components\Radio::make('status')
                    ->options([
                        Ad::STATUS_ACTIVE => 'Active',
                        Ad::STATUS_DRAFT => 'Draft',
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
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image'),

                Tables\Columns\TextColumn::make('url')
                    ->searchable(),

                Tables\Columns\IconColumn::make('status')
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
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
