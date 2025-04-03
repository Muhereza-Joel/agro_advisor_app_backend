<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VeterinaryOfficerResource\Pages;
use App\Filament\Resources\VeterinaryOfficerResource\RelationManagers;
use App\Models\VeterinaryOfficer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VeterinaryOfficerResource extends Resource
{
    protected static ?string $model = VeterinaryOfficer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationLabel = 'Veterinary Officer Profiles';

    protected static ?string $modelLabel = 'Veterinary Officer Profiles';

    protected static ?string $slug = 'veterinary-officer-profiles';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('vet', 'name')  // Display vet's name
                    ->preload()
                    ->searchable()
                    ->required()
                    ->label('Veterinary Officer')
                    ->afterStateUpdated(function ($state, $get) {
                        // The state will be the user_id of the selected vet, so we can just return it
                        return $state;
                    }),
                Forms\Components\TextInput::make('qualification')
                    ->required()
                    ->placeholder('Enter qualification here')
                    ->maxLength(191),
                Forms\Components\TextInput::make('specialization')
                    ->placeholder('Enter specialization here')
                    ->maxLength(191),
                Forms\Components\Select::make('subcounty_id')
                    ->required()
                    ->relationship('subcounty', 'name'),
                Forms\Components\TextInput::make('license_number')
                    ->required()
                    ->placeholder('Enter license number here')
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vet.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('qualification')
                    ->searchable(),
                Tables\Columns\TextColumn::make('specialization')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subcounty_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('license_number')
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
            'index' => Pages\ListVeterinaryOfficers::route('/'),
            'create' => Pages\CreateVeterinaryOfficer::route('/create'),
            'view' => Pages\ViewVeterinaryOfficer::route('/{record}'),
            'edit' => Pages\EditVeterinaryOfficer::route('/{record}/edit'),
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
