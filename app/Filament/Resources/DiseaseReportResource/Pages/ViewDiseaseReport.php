<?php

namespace App\Filament\Resources\DiseaseReportResource\Pages;

use App\Filament\Resources\DiseaseReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDiseaseReport extends ViewRecord
{
    protected static string $resource = DiseaseReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
