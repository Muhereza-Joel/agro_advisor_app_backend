<?php

namespace App\Filament\Resources\VeterinaryOfficerResource\Pages;

use App\Filament\Resources\VeterinaryOfficerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVeterinaryOfficers extends ListRecords
{
    protected static string $resource = VeterinaryOfficerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
