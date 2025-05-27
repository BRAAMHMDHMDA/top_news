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


    // counts icon
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'General';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fan_type')
                    ->required()
                    ->placeholder('Subscribers, Likes, Views')
                    ->maxLength(255),

                Forms\Components\TextInput::make('button_text')
                    ->required()
                    ->placeholder('Follow, Subscribe, Join, Like')
                    ->maxLength(255),

                Forms\Components\TextInput::make('icon')
                    ->required()
                    ->placeholder('fa fa-facebook')
                    ->maxLength(255),
                Forms\Components\TextInput::make('fan_count')
                    ->placeholder('100k')
                    ->required()
                    ->maxLength(255),

                Forms\Components\ColorPicker::make('color')
                    ->required()
                    ->placeholder('#FF0000'),

                Forms\Components\ToggleButtons::make('status')
                    ->label('Active?')
                    ->boolean('Active')
                    // active selected by default
                    ->default(true)
                    ->grouped(),
                Forms\Components\TextInput::make('url')
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

                Tables\Columns\IconColumn::make('icon')
                    ->label('Icon'),

                Tables\Columns\TextColumn::make('icon')
                    ->searchable()

                ,

                Tables\Columns\TextColumn::make('url')
                    ->searchable()
                    ->url(function ($record) {return $record->url;})
                    ->openUrlInNewTab()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('fan_count')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fan_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('button_text')
                    ->searchable(),

                Tables\Columns\ColorColumn::make('color')
                    ->copyable()
                    ->copyMessage('Color code copied')
                    ->copyMessageDuration(1500),

                Tables\Columns\ToggleColumn::make('status')
                    ->label('IsActive'),
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
            'index' => Pages\ManageSocialCounts::route('/'),
        ];
    }
}
