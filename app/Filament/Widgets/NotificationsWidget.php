<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\Subscriber;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NotificationsWidget extends BaseWidget
{
    use HasWidgetShield;

    protected static ?string $pollingInterval = '60s';
    protected static bool $isLazy = true;

    protected function getStats(): array
    {
        $newComments = Comment::where('status', false)->count();
        $newContacts = Contact::where('is_read', false)->count();
        $newSubscribers = Subscriber::whereDate('created_at', today())->count();

        return [
            Stat::make(__('filament::new_comments'), $newComments)
                ->description(__('filament::awaiting_moderation'))
                ->descriptionIcon('heroicon-o-chat-bubble-left-ellipsis')
                ->color($newComments > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.comments.index') . '?tableFilters[status][value]=0')
                ->extraAttributes(['class' => 'cursor-pointer']),

            Stat::make(__('filament::new_contacts'), $newContacts)
                ->description(__('filament::unread_messages'))
                ->descriptionIcon('heroicon-o-envelope')
                ->color($newContacts > 0 ? 'warning' : 'success')
                ->url(route('filament.admin.resources.contacts.index') . '?tableFilters[is_read][value]=0')
                ->extraAttributes(['class' => 'cursor-pointer']),

            Stat::make(__('filament::new_subscribers'), $newSubscribers)
                ->description(__('filament::today'))
                ->descriptionIcon('heroicon-o-user-plus')
                ->color('success')
                ->url(route('filament.admin.resources.subscribers.index'))
                ->extraAttributes(['class' => 'cursor-pointer']),
        ];
    }
}
