<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Mail\ReplyContact;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('filament::contacts');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament::general');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label(__('filament::email'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label(__('filament::subject'))
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_read')
                    ->label(__('filament::is_read')),
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
                Tables\Filters\SelectFilter::make('is_read')
                    ->label(__('filament::is_read'))
                    ->options([
                        1 => __('filament::read'),
                        0 => __('filament::unread'),
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading(__('filament::view_contact'))
                    ->mutateRecordDataUsing(function (array $data): array {
                        Contact::where('id', $data['id'])->update(['is_read' => true]);
                        $data['is_read'] = true;
                        return $data;
                    })
                    ->extraModalFooterActions([
                        Tables\Actions\Action::make('reply')
                            ->label(__('filament::reply'))
                            ->icon('heroicon-m-arrow-uturn-left')
                            ->form([
                                Forms\Components\RichEditor::make('reply_message')
                                    ->required()
                                    ->label(__('filament::reply_message')),
                            ])
                            ->action(function (array $data, Contact $record) {
                                Mail::to($record->email)->send(new ReplyContact(__('filament::reply_to') . $record->subject, $data['reply_message']));
                                Notification::make()
                                    ->success()
                                    ->title(__('filament::reply_sent'))
                                    ->send();
                            })
                            ->modalHeading(function ($record) {
                                return __('filament::reply_to') . $record->subject;
                            })
                            ->modalSubmitActionLabel(__('filament::send'))
                            ->closeModalByClickingAway(false),
                    ]),
                Tables\Actions\DeleteAction::make()
                    ->modalHeading(__('filament::delete_contact')),
                Tables\Actions\Action::make('reply')
                    ->label(__('filament::reply'))
                    ->icon('heroicon-m-arrow-uturn-left')
                    ->form([
                        Forms\Components\RichEditor::make('reply_message')
                            ->required()
                            ->label(__('filament::reply_message')),
                    ])
                    ->action(function (array $data, Contact $record) {

                        Mail::to($record->email)->send(new ReplyContact(__('filament::reply_to') . $record->subject, $data['reply_message']));
                        Notification::make()
                            ->success()
                            ->title(__('filament::reply_sent'))
                            ->send();
                    })
                    ->modalHeading(function ($record) {
                        return __('filament::reply_to') . $record->subject;
                    })
                    ->modalSubmitActionLabel(__('filament::send'))
                    ->closeModalByClickingAway(false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordClasses(function (Contact $record): string {
                return $record->is_read ? '' : 'bg-gray-200 dark:bg-gray-800';
            })
            ->defaultSort('created_at', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->label(__('filament::email'))
                    ->email()
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\TextInput::make('subject')
                    ->label(__('filament::subject'))
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Textarea::make('message')
                    ->label(__('filament::message'))
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('created_at')
                    ->label(__('filament::created_at'))
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContacts::route('/'),
        ];
    }

}
