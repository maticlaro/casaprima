<?php

namespace App\Filament\Resources\Services;

use App\Filament\Resources\Services\Pages\CreateService;
use App\Filament\Resources\Services\Pages\EditService;
use App\Filament\Resources\Services\Pages\ListServices;
use App\Models\Service;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_category_id')
                    ->relationship('serviceCategory', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                Textarea::make('short_description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('long_description')
                    ->columnSpanFull(),
                TextInput::make('icon'),
                TextInput::make('base_price')
                    ->required()
                    ->numeric(),
                Toggle::make('home_featured')
                    ->label('Home Featured')
                    ->default(false)
                    ->helperText('Display this service on the home page.'),
                TextInput::make('base_duration_minutes')
                    ->required()
                    ->numeric(),
                FileUpload::make('icon')
                    ->image()
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->required(),
                /*                 Toggle::make('is_emergency_available')
                    ->required(),
                TextInput::make('emergency_surcharge')
                    ->numeric(),
                TextInput::make('slug')
                    ->required(),

                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('travel_fee_per_km')
                    ->numeric(),
                Toggle::make('requires_site_inspection')
                    ->required(),
                Textarea::make('satisfaction_survey_template')
                    ->columnSpanFull(),
                TextInput::make('meta_title'),
                TextInput::make('meta_description'),
                TextInput::make('meta_keywords'),
                TextInput::make('og_title'),
                TextInput::make('og_description'),
                FileUpload::make('og_image')
                    ->image(),
                Textarea::make('schema_markup')
                    ->columnSpanFull(),
                TextInput::make('protocol_url'), */

                Section::make('Service Parameters')
                    ->description('Configure parameters and options for this service')
                    ->schema([
                        Repeater::make('serviceParameters')
                            ->label('Parameters')
                            ->relationship('serviceParameters')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->placeholder('Parameter name (e.g., "Tipo de superficie")'),
                                TextInput::make('description')
                                    ->placeholder('Optional description'),
                                Toggle::make('is_required')
                                    ->label('Required')
                                    ->default(true),
                                Repeater::make('serviceParameterOptions')
                                    ->label('Options')
                                    ->relationship('serviceParameterOptions')
                                    ->schema([
                                        TextInput::make('option_value')
                                            ->required()
                                            ->placeholder('Option name (e.g., "Madera", "Cerámico")'),
                                        TextInput::make('price_adjustment')
                                            ->numeric()
                                            ->default(0)
                                            ->prefix('$')
                                            ->placeholder('0')
                                            ->helperText('Price adjustment (+ or -)'),
                                        TextInput::make('duration_minutes_adjustment')
                                            ->numeric()
                                            ->default(0)
                                            ->suffix('min')
                                            ->placeholder('0')
                                            ->helperText('Duration adjustment (+ or -)'),
                                    ])
                                    ->columns(3)
                                    ->collapsible()
                                    ->cloneable()
                                    ->addActionLabel('Add Option')
                                    ->minItems(1),
                            ])
                            ->columns(1)
                            ->collapsible()
                            ->cloneable()
                            ->addActionLabel('Add Parameter')
                            ->orderColumn('sort_order')
                            ->reorderable(),
                    ])
                    ->columnSpanFull()
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('serviceCategory.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('icon')
                    ->searchable(),
                TextColumn::make('base_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('base_duration_minutes')
                    ->numeric(),
                BooleanColumn::make('home_featured')
                    ->label('Home Featured'),
                TextColumn::make('base_duration_minutes')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_emergency_available')
                    ->boolean(),
                TextColumn::make('emergency_surcharge')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                /*                 TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('travel_fee_per_km')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('requires_site_inspection')
                    ->boolean(),
                TextColumn::make('meta_title')
                    ->searchable(),
                TextColumn::make('meta_description')
                    ->searchable(),
                TextColumn::make('meta_keywords')
                    ->searchable(),
                TextColumn::make('og_title')
                    ->searchable(),
                TextColumn::make('og_description')
                    ->searchable(),
                ImageColumn::make('og_image'),
                TextColumn::make('protocol_url')
                    ->searchable(), */
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
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }
}
