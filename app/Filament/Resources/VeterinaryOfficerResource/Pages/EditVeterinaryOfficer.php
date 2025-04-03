<?php

namespace App\Filament\Resources\VeterinaryOfficerResource\Pages;

use App\Filament\Resources\VeterinaryOfficerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVeterinaryOfficer extends EditRecord
{
    protected static string $resource = VeterinaryOfficerResource::class;

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
