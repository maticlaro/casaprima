<?php

namespace App\Filament\Resources\ServiceParameters\Pages;

use App\Filament\Resources\ServiceParameters\ServiceParameterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceParameters extends ListRecords
{
    protected static string $resource = ServiceParameterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
