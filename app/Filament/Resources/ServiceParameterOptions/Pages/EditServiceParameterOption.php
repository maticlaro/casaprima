<?php

namespace App\Filament\Resources\ServiceParameterOptions\Pages;

use App\Filament\Resources\ServiceParameterOptions\ServiceParameterOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceParameterOption extends EditRecord
{
    protected static string $resource = ServiceParameterOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
