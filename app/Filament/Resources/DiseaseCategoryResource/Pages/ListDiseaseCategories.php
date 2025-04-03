<?php

namespace App\Filament\Resources\DiseaseCategoryResource\Pages;

use App\Filament\Resources\DiseaseCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiseaseCategories extends ListRecords
{
    protected static string $resource = DiseaseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
