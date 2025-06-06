<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcountyResource\Pages;
use App\Filament\Resources\SubcountyResource\RelationManagers;
use App\Models\Subcounty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubcountyResource extends Resource
{
    protected static ?string $model = Subcounty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return Subcounty::count(); // Count all users
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder('Enter subcounty name here')
                    ->maxLength(191),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Grid::make()
                    ->schema([
                        Tables\Columns\TextColumn::make('name')
                            ->searchable()
                    ])
                    ->columns(1) // Forces single column layout

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
            'index' => Pages\ListSubcounties::route('/'),
            'create' => Pages\CreateSubcounty::route('/create'),
            'view' => Pages\ViewSubcounty::route('/{record}'),
            'edit' => Pages\EditSubcounty::route('/{record}/edit'),
        ];
    }
}
