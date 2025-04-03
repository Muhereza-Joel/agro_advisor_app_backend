<?php

namespace App\Filament\Resources\DiseaseReportResource\Pages;

use App\Filament\Resources\DiseaseReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiseaseReport extends EditRecord
{
    protected static string $resource = DiseaseReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
