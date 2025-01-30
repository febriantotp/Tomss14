<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameRequestResource\Pages;
use App\Filament\Resources\GameRequestResource\RelationManagers;
use App\Models\GameRequest;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameRequestResource extends Resource
{
    protected static ?string $model = GameRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Game Information')->schema([
                    TextInput::make('game_name')
                        ->required()
                        ->maxLength(255),

                    Select::make('platform_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('platform', 'name'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('game_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('platform.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    DeleteAction::make(),
                ]),
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
            'index' => Pages\ListGameRequests::route('/'),
            'create' => Pages\CreateGameRequest::route('/create'),
            'edit' => Pages\EditGameRequest::route('/{record}/edit'),
        ];
    }
}
