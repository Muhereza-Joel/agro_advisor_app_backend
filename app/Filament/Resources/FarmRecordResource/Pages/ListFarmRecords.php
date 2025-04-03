<?php

namespace App\Filament\Resources\FarmRecordResource\Pages;

use App\Filament\Resources\FarmRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFarmRecords extends ListRecords
{
    protected static string $resource = FarmRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
