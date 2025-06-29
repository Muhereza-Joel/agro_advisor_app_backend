<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KnowledgeResource\Pages;
use App\Filament\Resources\KnowledgeResource\RelationManagers;
use App\Models\Knowledge;
use App\Models\KnowledgeResource as ModelsKnowledgeResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KnowledgeResource extends Resource
{
    protected static ?string $model = ModelsKnowledgeResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('resource_type')
                    ->label('Resource Type')
                    ->options([
                        'article' => 'Article',
                        'video' => 'Video',
                        'image' => 'Image',
                        'tutorial' => 'Tutorial',
                    ])
                    ->required(),

                Forms\Components\Select::make('livestock_type')
                    ->label('Livestock Type')
                    ->options([
                        'cattle' => 'Cattle',
                        'goats' => 'Goats',
                        'sheep' => 'Sheep',
                        'pigs' => 'Pigs',
                        'poultry' => 'Poultry',
                    ])
                    ->required(),

                Forms\Components\RichEditor::make('content')
                    ->label('Content')
                    ->columnSpan('full')
                    ->required(),

                Forms\Components\Select::make('disease_id')
                    ->label('Disease')
                    ->relationship('disease', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Toggle::make('is_featured')
                    ->label('Is Featured')
                    ->required(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListKnowledge::route('/'),
            'create' => Pages\CreateKnowledge::route('/create'),
            'view' => Pages\ViewKnowledge::route('/{record}'),
            'edit' => Pages\EditKnowledge::route('/{record}/edit'),
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
