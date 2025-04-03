<?php

namespace App\Filament\Resources\DiseaseCategoryResource\Pages;

use App\Filament\Resources\DiseaseCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiseaseCategory extends EditRecord
{
    protected static string $resource = DiseaseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
