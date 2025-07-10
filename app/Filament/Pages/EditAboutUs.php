<?php

namespace App\Filament\Pages;

use App\Models\About;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Tables\Actions\Action;

class EditAboutUs extends Page implements HasForms
{
    use InteractsWithForms;
    use HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.edit-about-us';
    protected static ?int $navigationSort = 4;
    public ?array $data = [];

    // TITLE

    public static function getNavigationLabel(): string
    {
        return __('filament::about_us_page');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament::general');
    }

    public function getTitle(): string
    {
        return __('filament::edit_aboutPage');
    }

    public function mount(): void
    {
        $content = About::firstOrFail()->content;
        $this->form->fill(
            [
                'content' => $content,
            ]
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('content')
                    ->label(__('filament::content'))
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h1',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();
            About::first()->update($data);
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

}
