<?php

namespace App\Filament\Resources\ServiceParameterOptions;

use App\Enums\MeasurementUnit;
use App\Filament\Resources\ServiceParameterOptions\Pages\CreateServiceParameterOption;
use App\Filament\Resources\ServiceParameterOptions\Pages\EditServiceParameterOption;
use App\Filament\Resources\ServiceParameterOptions\Pages\ListServiceParameterOptions;
use App\Models\ServiceParameterOption;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceParameterOptionResource extends Resource
{
    protected static ?string $model = ServiceParameterOption::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_parameter_id')
                    ->relationship('serviceParameter', 'name')
                    ->required(),
                TextInput::make('option_value')
                    ->required(),
                TextInput::make('price_adjustment')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('duration_minutes_adjustment')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('measurement_unit')
                    ->enum(enum: MeasurementUnit::class)
                    ->options(options: MeasurementUnit::class),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serviceParameter.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('option_value')
                    ->searchable(),
                TextColumn::make('price_adjustment')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('duration_minutes_adjustment')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('measurement_unit')
                    ->searchable(),
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
            'index' => ListServiceParameterOptions::route('/'),
            'create' => CreateServiceParameterOption::route('/create'),
            'edit' => EditServiceParameterOption::route('/{record}/edit'),
        ];
    }
}
