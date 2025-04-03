<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FarmerResource\Pages;
use App\Filament\Resources\FarmerResource\RelationManagers;
use App\Models\Farmer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Dotswan\MapPicker\Fields\Map;

class FarmerResource extends Resource
{
    protected static ?string $model = Farmer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Farms';

    protected static ?string $slug = 'farms';

    protected static ?string $modelLabel = 'Farms';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->relationship('farmer', 'name')
                    ->helperText('This is the farmer who owns the farm.'),
                Forms\Components\TextInput::make('farm_name')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('livestock_type')
                    ->options([
                        'cattle' => 'Cattle',
                        'goats' => 'Goat',
                        'sheep' => 'Sheep',
                        'pigs' => 'Pigs',
                        'poultry' => 'Poultry',

                    ])
                    ->preload()
                    ->searchable()
                    ->reactive()
                    ->required(),
                Forms\Components\TextInput::make('livestock_count')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('village_id')
                    ->required()
                    ->relationship('village', 'name')
                    ->preload()
                    ->searchable()
                    ->helperText('Select the village where the farm is located.'),
                Map::make('coordinates')
                    ->label('Location')
                    ->columnSpanFull()
                    ->helperText('Click on the map to select the location of the farm.')
                    ->defaultLocation(latitude: 0.609172, longitude: 30.641641)
                    ->draggable(true)
                    ->clickable(true)
                    ->zoom(15)
                    ->minZoom(0)
                    ->maxZoom(28)
                    ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png")
                    ->detectRetina(true)
                    ->reactive()
                    ->afterStateHydrated(function ($state, $set) {
                        // Convert array to string when state changes
                        if (is_array($state)) {
                            $set('coordinates', json_encode($state));
                        }
                    })
                    ->afterStateHydrated(function ($state, $set) {
                        // Convert string back to array when editing
                        if (is_string($state)) {
                            $set('coordinates', json_decode($state, true));
                        }
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('farmer.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('farm_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('livestock_type'),
                Tables\Columns\TextColumn::make('livestock_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('village.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListFarmers::route('/'),
            'create' => Pages\CreateFarmer::route('/create'),
            'view' => Pages\ViewFarmer::route('/{record}'),
            'edit' => Pages\EditFarmer::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
