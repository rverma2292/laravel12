<?php

namespace App\Filament\Widgets;

use App\Models\Comment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('New users joined')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Total Posts', Post::count())
                ->description('Articles published')
                ->descriptionIcon('heroicon-m-pencil')
                ->chart([7, 2, 10, 3, 15, 4, 17]) // This creates a small trend line
                ->color('info'),

            Stat::make('Categories', Category::count())
                ->description('Content segments'),

            Stat::make('Total comments', Comment::count())
            ->description('Comments published')
        ];
    }
}
