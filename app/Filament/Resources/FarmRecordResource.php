<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FarmRecordResource\Pages;
use App\Filament\Resources\FarmRecordResource\RelationManagers;
use App\Models\FarmRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmRecordResource extends Resource
{
    protected static ?string $model = FarmRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('farmer_id')
                    ->relationship('user.farmer', 'farm_name')
                    ->label('Farm Name')
                    ->placeholder('Select a farmer')
                    ->preload()
                    ->searchable()
                    ->reactive()
                    ->required(),
                Forms\Components\Select::make('record_type')
                    ->options([
                        'vaccination' => 'Vaccination',
                        'breeding' => 'Breeding',
                        'feeding' => 'Feeding',
                        'health' => 'Health',
                        'financial' => 'Financial',
                    ])
                    ->placeholder('Select a record type')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\RichEditor::make('details')
                    ->required()
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
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Select::make('related_disease_id')
                    ->relationship('relatedDisease', 'name')
                    ->label('Related Disease')
                    ->placeholder('Select a related disease')
                    ->preload()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('farmName.farm_name')
                    ->label('Farm Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('record_type'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),


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
            'index' => Pages\ListFarmRecords::route('/'),
            'create' => Pages\CreateFarmRecord::route('/create'),
            'view' => Pages\ViewFarmRecord::route('/{record}'),
            'edit' => Pages\EditFarmRecord::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);

        // if (auth()->check() && auth()->user()->hasRole('farmer')) {
        //     $farmer = auth()->user()->farmer; // assumes User hasOne Farmer

        //     if ($farmer) {
        //         return $query->where('farmer_id', $farmer->id);
        //     } else {
        //         // No farmer profile, return empty query
        //         return $query->whereRaw('1 = 0');
        //     }
        // }

        return $query;
    }
}
