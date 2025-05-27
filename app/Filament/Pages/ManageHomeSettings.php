<?php

namespace App\Filament\Pages;

use App\Settings\HomeSettings;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageHomeSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = HomeSettings::class;
    protected static bool $shouldRegisterNavigation = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Select::make('category_section_one')
                    ->label('Category Section One')
                    ->options(fn () => Category::pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('Select a category')
                    ->helperText('Select the category to display in section one of the home page'),
                \Filament\Forms\Components\Select::make('category_section_two')
                    ->label('Category Section Two')
                    ->options(fn () => Category::pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('Select a category')
                    ->helperText('Select the category to display in section two of the home page'),
                \Filament\Forms\Components\Select::make('category_section_three')
                    ->label('Category Section Three')
                    ->options(fn () => Category::pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('Select a category')
                    ->helperText('Select the category to display in section three of the home page'),
                \Filament\Forms\Components\Select::make('category_section_four')
                    ->label('Category Section Four')
                    ->options(fn () => Category::pluck('name', 'id'))
                    ->searchable()
                    ->placeholder('Select a category')
                    ->helperText('Select the category to display in section four of the home page'),
            ]);
    }
}
