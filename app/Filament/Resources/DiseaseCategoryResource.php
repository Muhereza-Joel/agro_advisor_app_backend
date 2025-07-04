<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiseaseCategoryResource\Pages;
use App\Filament\Resources\DiseaseCategoryResource\RelationManagers;
use App\Models\DiseaseCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiseaseCategoryResource extends Resource
{
    protected static ?string $model = DiseaseCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-open';

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return DiseaseCategory::count(); // Count all users
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder('Enter name of the disease category')
                    ->maxLength(191),
                Forms\Components\RichEditor::make('description')
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
                    ->placeholder('Enter description of the disease category')
                    ->columnSpanFull(),
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
            'index' => Pages\ListDiseaseCategories::route('/'),
            'create' => Pages\CreateDiseaseCategory::route('/create'),
            'view' => Pages\ViewDiseaseCategory::route('/{record}'),
            'edit' => Pages\EditDiseaseCategory::route('/{record}/edit'),
        ];
    }
}
