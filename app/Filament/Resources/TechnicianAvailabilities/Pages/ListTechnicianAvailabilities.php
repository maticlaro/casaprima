<?php

namespace App\Filament\Resources\TechnicianAvailabilities\Pages;

use App\Filament\Resources\TechnicianAvailabilities\TechnicianAvailabilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTechnicianAvailabilities extends ListRecords
{
    protected static string $resource = TechnicianAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
