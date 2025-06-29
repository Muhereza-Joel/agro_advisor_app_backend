<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiseaseResource\Pages;
use App\Filament\Resources\DiseaseResource\RelationManagers;
use App\Models\Disease;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiseaseResource extends Resource
{
    protected static ?string $model = Disease::class;

    protected static ?string $navigationIcon = 'heroicon-o-bug-ant';

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return Disease::count(); // Count all users
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->placeholder('Enter the disease name')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable()
                    ->reactive(),
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
                    ->columnSpanFull()
                    ->placeholder('Enter the symptoms of the disease that farmers should look out for in their livestock, e.g. fever, coughing, etc.')
                    ->extraAttributes(['style' => 'min-height: 300px;']),

                Forms\Components\RichEditor::make('prevention')
                    ->placeholder('Enter the prevention methods for the disease, e.g. vaccination, hygiene practices, etc.')
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
                Forms\Components\RichEditor::make('treatment')
                    ->placeholder('Enter the treatment methods for the disease, e.g. medications, veterinary care, etc.')
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
                Forms\Components\Toggle::make('is_zoonotic')
                    ->required(),
                Forms\Components\TextInput::make('key_symptoms')
                    ->required()
                    ->placeholder('Enter the key symptoms of the disease that farmers should look out for in their livestock, e.g. fever, coughing, etc.')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('secondary_symptoms')
                    ->required()
                    ->placeholder('Enter the secondary symptoms of the disease that farmers should look out for in their livestock, e.g. fever, coughing, etc.')
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
            'index' => Pages\ListDiseases::route('/'),
            'create' => Pages\CreateDisease::route('/create'),
            'view' => Pages\ViewDisease::route('/{record}'),
            'edit' => Pages\EditDisease::route('/{record}/edit'),
        ];
    }
}
