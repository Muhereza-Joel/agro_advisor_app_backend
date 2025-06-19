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
                ->icon('heroicon-o-user-group')
                ->url(route('filament.dashboard.resources.users.index')),

            Stat::make('Diseases', Disease::count())
                ->description('All diseases')
                ->icon('heroicon-o-bug-ant')
                ->url(route('filament.dashboard.resources.diseases.index')),

            Stat::make('Outbreak Alerts', OutbreakAlert::count())
                ->description('Recent alerts')
                ->icon('heroicon-o-exclamation-triangle')
                ->color('danger')
                ->url(route('filament.dashboard.resources.disease-outbreak-alerts.index')),

            Stat::make('Disease Reports', DiseaseReport::count())
                ->description('Submitted reports')
                ->icon('heroicon-o-clipboard-document-check')
                ->color('warning')
                ->url(route('filament.dashboard.resources.disease-reports.index')),

            Stat::make('Questions', Advisory::count())
                ->description('User inquiries')
                ->icon('heroicon-o-question-mark-circle')
                ->color('primary')
                ->url(route('filament.dashboard.resources.questions.index')),

        ];
    }
}
