<?php

namespace App\Filament\Resources\ServiceParameters\Pages;

use App\Filament\Resources\ServiceParameters\ServiceParameterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceParameter extends EditRecord
{
    protected static string $resource = ServiceParameterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
