<?php

namespace App\Filament\Resources\TechnicianAvailabilities;

use App\Filament\Resources\TechnicianAvailabilities\Pages\CreateTechnicianAvailability;
use App\Filament\Resources\TechnicianAvailabilities\Pages\EditTechnicianAvailability;
use App\Filament\Resources\TechnicianAvailabilities\Pages\ListTechnicianAvailabilities;
use App\Models\TechnicianAvailability;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TechnicianAvailabilityResource extends Resource
{
    protected static ?string $model = TechnicianAvailability::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('technician_id')
                    ->relationship('technician', 'first_name')
                    ->required(),
                DateTimePicker::make('start_datetime')
                    ->required(),
                DateTimePicker::make('end_datetime')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('technician.first_name')

                    ->sortable(),
                TextColumn::make('start_datetime')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_datetime')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTechnicianAvailabilities::route('/'),
            'create' => CreateTechnicianAvailability::route('/create'),
            'edit' => EditTechnicianAvailability::route('/{record}/edit'),
        ];
    }
}
