<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvisoryResource\Pages;
use App\Filament\Resources\AdvisoryResource\RelationManagers;
use App\Models\Advisory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdvisoryResource extends Resource
{
    protected static ?string $model = Advisory::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?int $navigationSort = 12;

    protected static ?string $navigationLabel = 'Questions';

    protected static ?string $modelLabel = 'Question';

    protected static ?string $slug = 'questions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('farmer_id')
                    ->label('Farm Name')
                    ->relationship('farmer', 'farm_name')
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('user_id') // Change from 'user_id' to 'vet_id'
                    ->relationship('vet', 'name')  // Display vet's name
                    ->preload()
                    ->searchable()
                    ->required(),
                Forms\Components\RichEditor::make('question')
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
                Forms\Components\RichEditor::make('response')
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
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'responded' => 'Responded',
                    ])
                    ->required(),
                Forms\Components\Select::make('related_disease_id')
                    ->label('Disease')
                    ->relationship('disease', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('farmer.farm_name')
                    ->label('Farm Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vet.name')
                    ->label('Veterinary Officer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('disease.name')
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
            'index' => Pages\ListAdvisories::route('/'),
            'create' => Pages\CreateAdvisory::route('/create'),
            'view' => Pages\ViewAdvisory::route('/{record}'),
            'edit' => Pages\EditAdvisory::route('/{record}/edit'),
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
