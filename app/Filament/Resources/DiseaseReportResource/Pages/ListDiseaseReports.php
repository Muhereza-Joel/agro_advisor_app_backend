<?php

namespace App\Filament\Resources\DiseaseReportResource\Pages;

use App\Filament\Resources\DiseaseReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiseaseReports extends ListRecords
{
    protected static string $resource = DiseaseReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
