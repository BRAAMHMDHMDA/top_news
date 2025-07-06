<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\News;
use App\Models\Subscriber;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
//        $newComments = Comment::where('status', false)->count();
//        $newContacts = Contact::where('is_read', false)->count();
//        $newSubscribers = Subscriber::whereDate('created_at', today())->count();

        return [
            Stat::make('Total Customers', Customer::count())
                ->description('Number of registered customers')
                ->descriptionIcon('heroicon-o-users')
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->url(route('filament.admin.resources.customers.index'))
                ->color('primary'),

            Stat::make('Total News', News::activeEntries()->count())
                ->description('Number of published news articles')
                ->descriptionIcon('heroicon-o-newspaper')
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->url(route('filament.admin.resources.news.index') . '?tableFilters[status][value]=1&tableFilters[is_approved][value]=1')
                ->color('primary'),

            Stat::make('Total Subscribers', Subscriber::count())
                ->description('Number of Subscribers')
                ->descriptionIcon('heroicon-o-envelope')
                ->extraAttributes(['class' => 'cursor-pointer'])
                ->url(route('filament.admin.resources.subscribers.index'))
                ->color('primary'),

//            Stat::make('New Comments', $newComments)
//                ->description('Awaiting moderation')
//                ->descriptionIcon('heroicon-o-chat-bubble-left-ellipsis')
//                ->color($newComments > 0 ? 'warning' : 'success')
//                ->url(route('filament.admin.resources.comments.index') . '?tableFilters[status][value]=0')
//                ->extraAttributes(['class' => 'cursor-pointer']),
//
//            Stat::make('New Contacts', $newContacts)
//                ->description('Unread messages')
//                ->descriptionIcon('heroicon-o-envelope')
//                ->color($newContacts > 0 ? 'warning' : 'success')
//                ->url(route('filament.admin.resources.contacts.index') . '?tableFilters[is_read][value]=0')
//                ->extraAttributes(['class' => 'cursor-pointer']),
//
//            Stat::make('New Subscribers', $newSubscribers)
//                ->description('Today')
//                ->descriptionIcon('heroicon-o-user-plus')
//                ->color('success')
//                ->url(route('filament.admin.resources.subscribers.index'))
//                ->extraAttributes(['class' => 'cursor-pointer']),
        ];
    }
}
