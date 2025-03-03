<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use App\Models\Post;
use App\Models\Project;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total_and_new_visitors = Visitor::selectRaw('COUNT(*) as total_visitors, SUM(CASE WHEN created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) as new_visitors', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->where('user_id', Auth::id())->first();

        $total_visitors = $total_and_new_visitors->total_visitors ?? 0;
        $new_visitors   = $total_and_new_visitors->new_visitors ?? 0;

        $total_and_new_projects = Project::selectRaw('COUNT(*) as total_projects, SUM(CASE WHEN created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) as new_projects', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->where('user_id', Auth::id())->first();
        $total_projects = $total_and_new_projects->total_projects ?? 0;
        $new_projects   = $total_and_new_projects->new_projects ?? 0;

        $total_and_new_posts = Post::selectRaw('COUNT(*) as total_posts, SUM(CASE WHEN created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) as new_posts', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->where('user_id', Auth::id())->first();
        $total_posts = $total_and_new_posts->total_posts ?? 0;
        $new_posts   = $total_and_new_posts->new_posts ?? 0;

        $total_and_new_messages = Message::selectRaw('COUNT(*) as total_messages, SUM(CASE WHEN created_at BETWEEN ? AND ? THEN 1 ELSE 0 END) as new_messages', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->where('user_id', Auth::id())->first();
        $total_messages = $total_and_new_messages->total_messages ?? 0;
        $new_messages   = $total_and_new_messages->new_messages ?? 0;

        $stats = [];

        $stats[] = Stat::make('Total Visitors', $total_visitors)
            ->description($new_visitors . ' this month')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->extraAttributes(['class' => 'cursor-pointer']),
            // ->url(route('filament.admin.resources.users.index'))
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('primary');

        $stats[] = Stat::make('Total Projects', $total_projects)
            ->description($new_projects . ' this month')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->extraAttributes(['class' => 'cursor-pointer']),
            // ->url(route('filament.admin.resources.users.index'))
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('danger');

        $stats[] = Stat::make('Total Posts', $total_posts)
            ->description($new_posts . ' this month')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->extraAttributes(['class' => 'cursor-pointer']),
            // ->url(route('filament.admin.resources.users.index'))
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('warning');

        $stats[] = Stat::make('Total Messages', $total_messages)
            ->description($new_messages . ' this month')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            // ->extraAttributes(['class' => 'cursor-pointer']),
            // ->url(route('filament.admin.resources.users.index'))
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success');

        return $stats;
    }
}
