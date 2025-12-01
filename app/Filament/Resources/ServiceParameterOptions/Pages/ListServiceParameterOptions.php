<?php

namespace App\Filament\Resources\ServiceParameterOptions\Pages;

use App\Filament\Resources\ServiceParameterOptions\ServiceParameterOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceParameterOptions extends ListRecords
{
    protected static string $resource = ServiceParameterOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
