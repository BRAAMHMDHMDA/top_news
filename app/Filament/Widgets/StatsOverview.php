<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\News;
use App\Models\Subscriber;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
            Stat::make(__('filament::total_customers'), Customer::count())
                ->description(__('filament::number_of_registered_customers'))
                ->descriptionIcon('heroicon-o-users')
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->url(route('filament.admin.resources.customers.index'))
                ->color('primary'),

            Stat::make(__('filament::total_news'), News::activeEntries()->count())
                ->description(__('filament::number_of_published_news'))
                ->descriptionIcon('heroicon-o-newspaper')
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->url(route('filament.admin.resources.news.index') . '?tableFilters[status][value]=1&tableFilters[is_approved][value]=1')
                ->color('primary'),

            Stat::make(__('filament::total_subscribers'), Subscriber::count())
                ->description(__('filament::number_of_subscribers'))
                ->descriptionIcon('heroicon-o-envelope')
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->url(route('filament.admin.resources.subscribers.index'))
                ->color('primary'),
        ];
    }
}
