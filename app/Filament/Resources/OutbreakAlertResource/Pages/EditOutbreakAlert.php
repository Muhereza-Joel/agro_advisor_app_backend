<?php

namespace App\Filament\Resources\OutbreakAlertResource\Pages;

use App\Filament\Resources\OutbreakAlertResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOutbreakAlert extends EditRecord
{
    protected static string $resource = OutbreakAlertResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
