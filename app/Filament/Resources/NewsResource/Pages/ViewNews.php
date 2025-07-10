<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewNews extends ViewRecord
{
    // Use the correct Translatable trait for ViewRecord
    use \Filament\Resources\Pages\ViewRecord\Concerns\Translatable;

    protected static string $resource = NewsResource::class;

    public function getTitle(): string
    {
        return __('filament::view_news');
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                    ->schema([
                        ImageEntry::make('image_path')
                            ->label('')
                            ->disk('public')
                            ->height(200)
                            ->width('100%')
                            ->defaultImageUrl(asset('images/fallback.jpg'))
                            ->columnSpanFull(),
//                            ->extraAttributes(['class' => 'rounded-lg shadow-lg mb-6 object-cover']),
                        TextEntry::make('title')
                            ->label('')
                            ->formatStateUsing(fn($state) => "<h1 class='text-3xl font-bold mb-4'>{$state}</h1>")
                            ->html()
                            ->columnSpanFull(),
                        TextEntry::make('metadata')
                            ->label('')
                            ->getStateUsing(function ($record) {
                                $locale = app()->getLocale();
                                $category = $record->category ? $record->category->getTranslation('name', $locale) : __('filament::no_category');
                                $author = $record->author ? $record->author->name : __('filament::unknown');
                                $date = $record->created_at ? $record->created_at->format('M j, Y') : __('filament::n_a');
                                return __('filament.posted_in_by_on', [
                                    'category' => $category,
                                    'author' => $author,
                                    'date' => $date
                                ]);
                            })
                            ->formatStateUsing(fn($state) => "<p class='text-gray-600 italic mb-6'>{$state}</p>")
                            ->html()
                            ->columnSpanFull(),
                        TextEntry::make('content')
                            ->label('')
                            ->markdown()
                            ->columnSpanFull()
                            ->extraAttributes(['class' => 'prose max-w-none text-gray-800 leading-relaxed']),
                    ])
                    ->extraAttributes(['class' => 'bg-white p-8 rounded-lg shadow-sm mb-6']),

                Section::make(__('filament::article_metadata'))
                    ->schema([
                        Section::make(__('filament::seo_details'))
                            ->schema([
                                TextEntry::make('meta_title')
                                    ->label(__('filament::meta_title'))
                                    ->color('gray'),
                                TextEntry::make('meta_description')
                                    ->label(__('filament::meta_description'))
                                    ->color('gray'),
                                TextEntry::make('slug')
                                    ->label(__('filament::slug'))
                                    ->color('gray'),
                            ])
                            ->columns(1)
                            ->collapsible(),
                        Section::make(__('filament::publication_settings'))
                            ->schema([
                                IconEntry::make('status')
                                    ->label(__('filament::published'))
                                    ->boolean()
                                    ->trueIcon('heroicon-o-check-circle')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success')
                                    ->falseColor('danger'),
                                IconEntry::make('is_breaking_news')
                                    ->label(__('filament::breaking_news'))
                                    ->boolean()
                                    ->trueIcon('heroicon-o-fire')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('warning'),
                                IconEntry::make('show_at_slider')
                                    ->label(__('filament::show_in_slider'))
                                    ->boolean()
                                    ->trueIcon('heroicon-o-view-columns')
                                    ->falseIcon('heroicon-o-x-circle'),
                                IconEntry::make('show_at_popular')
                                    ->label(__('filament::show_in_popular'))
                                    ->boolean()
                                    ->trueIcon('heroicon-o-star')
                                    ->falseIcon('heroicon-o-x-circle'),
                                IconEntry::make('is_approved')
                                    ->label(__('filament::approved'))
                                    ->boolean()
                                    ->trueIcon('heroicon-o-shield-check')
                                    ->falseIcon('heroicon-o-x-circle')
                                    ->trueColor('success'),
                            ])
                            ->columns(5)
                            ->collapsible(),
                        Section::make(__('filament::timestamps'))
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label(__('filament::created_at'))
                                    ->dateTime('M j, Y H:i')
                                    ->default(__('filament::n_a')),
                                TextEntry::make('updated_at')
                                    ->label(__('filament::updated_at'))
                                    ->dateTime('M j, Y H:i')
                                    ->default(__('filament::n_a')),
                            ])
                            ->columns(2)
                            ->collapsible(),

                    ])
                    ->columns(1)
                    ->columnSpan(['lg' => 1])
                    ->extraAttributes(['class' => 'bg-gray-50 p-6 rounded-lg shadow-sm']),
            ])
            ->columns(1);
    }

    public function setActiveLocale($locale)
    {
        $this->activeLocale = $locale;
        app()->setLocale($locale);
        $this->refreshForm();
    }

    // Listen for locale changes and refresh the page

    protected function refreshForm()
    {
        $this->fillForm();
    }

    // Ensure the form refreshes when locale changes

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
