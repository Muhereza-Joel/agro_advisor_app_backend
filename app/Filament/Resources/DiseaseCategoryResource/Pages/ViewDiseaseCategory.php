<?php

namespace App\Filament\Resources\DiseaseCategoryResource\Pages;

use App\Filament\Resources\DiseaseCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDiseaseCategory extends ViewRecord
{
    protected static string $resource = DiseaseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
