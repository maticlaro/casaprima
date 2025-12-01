<?php

namespace App\Filament\Resources\TechnicianAvailabilities\Pages;

use App\Filament\Resources\TechnicianAvailabilities\TechnicianAvailabilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTechnicianAvailability extends EditRecord
{
    protected static string $resource = TechnicianAvailabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
