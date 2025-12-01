<?php

namespace App\Filament\Resources\Technicians\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TechnicianAvailabilitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'technicianAvailabilities';

    protected static ?string $title = 'Disponibilidad';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('start_datetime')
                    ->label('Inicio')
                    ->seconds(false)
                    ->required(),
                DateTimePicker::make('end_datetime')
                    ->label('Término')
                    ->seconds(false)
                    ->required()
                    ->rule('after:start_datetime'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('start_datetime')->dateTime('Y-m-d H:i'),
                TextColumn::make('end_datetime')->dateTime('Y-m-d H:i'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
