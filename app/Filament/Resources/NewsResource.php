<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends Resource
{
    use Translatable;

    protected static ?string $model = News::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('filament::news');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament::news');
    }

    // breadcrumb
    public static function getBreadcrumb(): string
    {
        return __('filament::news');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')
                        ->label(__('filament::title'))
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('tags')
                        ->label(__('filament::tags'))
                        ->multiple()
                        ->preload()
                        ->relationship(name: 'tags', titleAttribute: 'name')
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->label(__('filament::name'))
                                ->required(),
                        ]),

                    Forms\Components\Select::make('category_id')
                        ->label(__('filament::category'))
                        ->relationship('category', 'name')
                        ->getOptionLabelFromRecordUsing(function ($record, $livewire) {
                            $locale = $livewire->activeLocale ?? app()->getLocale();
                            return $record->getTranslation('name', $locale);
                        })
                        ->required(),

                    Forms\Components\FileUpload::make('image_path')
                        ->label(__('filament::image'))
                        ->disk('public')
                        ->directory('news')
                        ->image()
                        ->required(),

                    Forms\Components\RichEditor::make('content')
                        ->label(__('filament::content'))
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Fieldset::make(__('filament::seo'))->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label(__('filament::meta_title'))
                            ->maxLength(255)
                            ->columnSpan(4),
                        Forms\Components\TextInput::make('meta_description')
                            ->label(__('filament::meta_description'))
                            ->maxLength(255)
                            ->columnSpan(4),
                    ]),

                    Forms\Components\Fieldset::make(__('filament::settings'))->schema([
                        Forms\Components\Toggle::make('status')
                            ->label(__('filament::status'))
                            ->required(),
                        Forms\Components\Toggle::make('is_breaking_news')
                            ->label(__('filament::is_breaking_news'))
                            ->required(),
                        Forms\Components\Toggle::make('show_at_slider')
                            ->label(__('filament::show_at_slider'))
                            ->required(),
                        Forms\Components\Toggle::make('show_at_popular')
                            ->label(__('filament::show_at_popular'))
                            ->required(),
                    ])->columns(4),

                ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label(__('filament::image'))
                    ->disk('public') // Specify storage disk if needed
                    ->size(50), // Optional: Set image size

                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament::title'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament::category'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label(__('filament::author'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament::slug'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),


                Tables\Columns\IconColumn::make('is_breaking_news')
                    ->label(__('filament::is_breaking_news'))
                    ->boolean()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('show_at_slider')
                    ->label(__('filament::show_at_slider'))
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('show_at_popular')
                    ->label(__('filament::show_at_popular'))
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('filament::status')),
                Tables\Columns\ToggleColumn::make('is_approved')
                    ->label(__('filament::is_approved')),
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
                Tables\Filters\SelectFilter::make('category')
                    ->label(__('filament::category'))
                    ->relationship('category', 'name')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('tags')
                    ->label(__('filament::tags'))
                    ->relationship('tags', 'name')
                    ->multiple()
                    ->searchable(),
                Tables\Filters\SelectFilter::make('user')
                    ->label(__('filament::author'))
                    ->relationship('user', 'name')
                    ->searchable(),
                Tables\Filters\TernaryFilter::make('status')
                    ->label(__('filament::status')),
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label(__('filament::is_approved')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('filament::delete_news')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordAction('view');

    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'view' => Pages\ViewNews::route('/{record}'),
            'edit' => Pages\EditNews::route('/{record}/edit'),


        ];
    }

}
