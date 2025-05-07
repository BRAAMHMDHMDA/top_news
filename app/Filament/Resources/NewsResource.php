<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\Tag;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use App\Models\Category;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    use Translatable;

    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'News';
    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Section::make()->schema([
                   Forms\Components\TextInput::make('title')
                       ->required()
                       ->maxLength(255),
                   Forms\Components\Select::make('tags')
                       ->multiple()
                       ->preload()
                       ->relationship(name: 'tags', titleAttribute: 'name')
                       ->createOptionForm([
                           Forms\Components\TextInput::make('name')
                               ->required(),

                       ]),

                   Forms\Components\Select::make('category_id')
                       ->relationship('category', 'name')
                       ->getOptionLabelFromRecordUsing(function ($record, $livewire) {
                           $locale = $livewire->activeLocale ?? app()->getLocale();
                           return $record->getTranslation('name', $locale);
                       })
                       ->required(),

                   Forms\Components\FileUpload::make('image_path')
                       ->label('Image')
                       ->disk('public')
                       ->directory('news')
                       ->image()
                       ->required(),

                   Forms\Components\RichEditor::make('content')
                       ->required()
                       ->columnSpanFull(),
                   Forms\Components\Fieldset::make('SEO')->schema([
                       Forms\Components\TextInput::make('meta_title')
                           ->maxLength(255)->columnSpan(4),
                       Forms\Components\TextInput::make('meta_description')
                           ->maxLength(255)->columnSpan(4),
                   ]),

                   Forms\Components\Fieldset::make('Settings')->schema([
                       Forms\Components\Toggle::make('status')
                           ->required(),
                       Forms\Components\Toggle::make('is_breaking_news')
                           ->required(),
                       Forms\Components\Toggle::make('show_at_slider')
                           ->required(),
                       Forms\Components\Toggle::make('show_at_popular')
                           ->required(),
                   ])->columns(4),

               ])->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public') // Specify storage disk if needed
                    ->size(50), // Optional: Set image size

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),

                    Tables\Columns\TextColumn::make('user.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_breaking_news')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('show_at_slider')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('show_at_popular')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->boolean(),
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
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->searchable(),
                Tables\Filters\SelectFilter::make('tags')
                    ->relationship('tags', 'name')
                    ->multiple()
                    ->searchable(),
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->searchable(),
                Tables\Filters\TernaryFilter::make('status'),
                Tables\Filters\TernaryFilter::make('is_approved'),

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
