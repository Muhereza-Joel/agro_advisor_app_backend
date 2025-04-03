<?php

namespace App\Filament\Resources\OutbreakAlertResource\Pages;

use App\Filament\Resources\OutbreakAlertResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOutbreakAlert extends ViewRecord
{
    protected static string $resource = OutbreakAlertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
