<?php

namespace App\Filament\Widgets;

use App\Models\Advisory;
use App\Models\Disease;
use App\Models\DiseaseReport;
use App\Models\OutbreakAlert;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('All users')
                ->icon('heroicon-o-user-group'),

            Stat::make('Diseases', Disease::count())
                ->description('All diseases')
                ->icon('heroicon-o-bug-ant'),

            Stat::make('Outbreak Alerts', OutbreakAlert::count())
                ->description('Recent alerts')
                ->icon('heroicon-o-exclamation-triangle')
                ->color('danger'),

            Stat::make('Disease Reports', DiseaseReport::count())
                ->description('Submitted reports')
                ->icon('heroicon-o-clipboard-document-check')
                ->color('warning'),

            Stat::make('Questions', Advisory::count())
                ->description('User inquiries')
                ->icon('heroicon-o-question-mark-circle')
                ->color('primary')

        ];
    }
}
