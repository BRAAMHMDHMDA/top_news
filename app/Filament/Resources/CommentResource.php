<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('filament::comments');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament::news');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('filament::comment'))
                    ->limit(40)
                    ->sortable(),
                Tables\Columns\TextColumn::make('news.title')
                    ->label(__('filament::article'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label(__('filament::customer'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment.comment')
                    ->label(__('filament::parent_comment'))
                    ->disabled()
                    ->visible(fn($record) => $record?->parent_id !== null),
                Tables\Columns\ToggleColumn::make('status')
                    ->label(__('filament::approved'))
                    ->afterStateUpdated(function ($record, $state) {
                        Notification::make()
                            ->title(__('filament::status_updated'))
                            ->body(__('filament::comment_status_updated', [
                                'title' => $record->news->title,
                                'status' => $state ? __('filament::approved') : __('filament::unapproved')
                            ]))
                            ->success()
                            ->send();
                    }),
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
                Tables\Filters\SelectFilter::make('news')
                    ->relationship('news', 'title')
                    ->searchable()
                    ->label(__('filament::news_title')),
                Tables\Filters\TernaryFilter::make('status')
                    ->label(__('filament::status')),
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->label(__('filament::customer_name')),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label(__('filament::created_from')),
                        Forms\Components\DatePicker::make('created_until')
                            ->label(__('filament::created_until')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date)
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators[] = __('filament::created_from') . ': ' . $data['created_from'];
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators[] = __('filament::created_until') . ': ' . $data['created_until'];
                        }
                        return $indicators;
                    }),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading(__('filament::view_comment')),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('filament::delete_comment')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('news_id')
                    ->relationship('news', 'title')
                    ->label(__('filament::news'))
                    ->required(),
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->label(__('filament::customer'))
                    ->required(),
                Forms\Components\Select::make('parent_id')
                    ->nullable()
                    ->relationship('parent', 'comment')
                    ->label(__('filament::parent_comment'))
                    ->disabled()
                    ->visible(fn($record) => $record?->parent_id !== null),
                Forms\Components\Textarea::make('comment')
                    ->label(__('filament::comment'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('status')
                    ->label(__('filament::status'))
                    ->required(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageComments::route('/'),
        ];
    }
}
