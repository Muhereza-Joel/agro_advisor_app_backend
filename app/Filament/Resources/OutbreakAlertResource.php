<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OutbreakAlertResource\Pages;
use App\Filament\Resources\OutbreakAlertResource\RelationManagers;
use App\Models\OutbreakAlert;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OutbreakAlertResource extends Resource
{
    protected static ?string $model = OutbreakAlert::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell-alert';

    protected static ?int $navigationSort = 11;

    protected static ?string $navigationLabel = 'Disease Outbreak Alerts';

    protected static ?string $modelLabel = 'Disease Outbreak Alerts';

    protected static ?string $slug = 'disease-outbreak-alerts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('disease_id')
                    ->label('Disease')
                    ->relationship('disease', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('subcounty_id')
                    ->label('Subcounty')
                    ->relationship('subcounty', 'name')
                    ->preload()
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('severity')
                    ->label('Severity')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'critical' => 'Critical',
                    ])
                    ->required(),
                Forms\Components\RichEditor::make('description')
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
                Forms\Components\RichEditor::make('recommendations')
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
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('disease_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subcounty_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('severity'),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_by')
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
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOutbreakAlerts::route('/'),
            'create' => Pages\CreateOutbreakAlert::route('/create'),
            'view' => Pages\ViewOutbreakAlert::route('/{record}'),
            'edit' => Pages\EditOutbreakAlert::route('/{record}/edit'),
        ];
    }
}
