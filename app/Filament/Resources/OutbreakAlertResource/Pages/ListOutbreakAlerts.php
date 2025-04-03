<?php

namespace App\Filament\Resources\OutbreakAlertResource\Pages;

use App\Filament\Resources\OutbreakAlertResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOutbreakAlerts extends ListRecords
{
    protected static string $resource = OutbreakAlertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
