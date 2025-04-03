<?php

namespace App\Filament\Resources\DiseaseCategoryResource\Pages;

use App\Filament\Resources\DiseaseCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDiseaseCategory extends CreateRecord
{
    protected static string $resource = DiseaseCategoryResource::class;
}
