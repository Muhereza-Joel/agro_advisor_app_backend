<?php

namespace App\Filament\Resources\VeterinaryOfficerResource\Pages;

use App\Filament\Resources\VeterinaryOfficerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVeterinaryOfficer extends ViewRecord
{
    protected static string $resource = VeterinaryOfficerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
