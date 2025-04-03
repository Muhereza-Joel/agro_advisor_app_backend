<?php

namespace App\Filament\Resources\FarmRecordResource\Pages;

use App\Filament\Resources\FarmRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFarmRecord extends EditRecord
{
    protected static string $resource = FarmRecordResource::class;

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
