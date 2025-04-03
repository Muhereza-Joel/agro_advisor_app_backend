<?php

namespace App\Filament\Resources\FarmRecordResource\Pages;

use App\Filament\Resources\FarmRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFarmRecord extends ViewRecord
{
    protected static string $resource = FarmRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
