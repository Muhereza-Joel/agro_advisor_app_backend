<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiseaseReportResource\Pages;
use App\Filament\Resources\DiseaseReportResource\RelationManagers;
use App\Models\DiseaseReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiseaseReportResource extends Resource
{
    protected static ?string $model = DiseaseReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('farmer_id')
                    ->relationship('farmer', 'name')
                    ->required()
                    ->helperText('This is the farmer who is reporting the disease.'),

                Forms\Components\Select::make('vet_id')
                    ->relationship('vet', 'name')
                    ->label('Veterinary Officer')
                    ->required()
                    ->helperText('Select the veterinary officer who will diagnose the disease.'),

                Forms\Components\Select::make('disease_id')
                    ->relationship('disease', 'name')
                    ->required()
                    ->helperText('Select the disease that is affecting the livestock.')
                    ->preload()
                    ->searchable()
                    ->label('Disease'),

                Forms\Components\Select::make('livestock_type')
                    ->required()
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

                Forms\Components\RichEditor::make('symptoms')
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'blockquote',
                        'redo',
                        'undo',
                    ])
                    ->required(),

                Forms\Components\Select::make('severity')
                    ->required()
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'critical' => 'Critical',
                    ])
                    ->required(),
                Forms\Components\Select::make('village_id')
                    ->required()
                    ->relationship('village', 'name')
                    ->preload()
                    ->searchable()
                    ->helperText('Select the village where the disease is reported.'),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options([
                        'pending' => 'Pending',
                        'diagnosed' => 'Diagnosed',
                        'treated' => 'Treated',
                        'resolved' => 'Resolved',

                    ])
                    ->preload()
                    ->searchable()
                    ->reactive()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('farmer_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vet_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('disease_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('livestock_type'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('severity'),
                Tables\Columns\TextColumn::make('village_id')
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
            'index' => Pages\ListDiseaseReports::route('/'),
            'create' => Pages\CreateDiseaseReport::route('/create'),
            'view' => Pages\ViewDiseaseReport::route('/{record}'),
            'edit' => Pages\EditDiseaseReport::route('/{record}/edit'),
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
