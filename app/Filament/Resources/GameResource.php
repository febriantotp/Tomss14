<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Filament\Resources\GameResource\RelationManagers;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-rocket-launch';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Game Information')->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur:true)
                        ->afterStateUpdated(function(string $operation, $state, Set $set){
                            if ($operation !== 'create') {
                                return;
                            }
                            $set('slug', Str::slug($state));
                        }),

                    TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->disabled()
                        ->dehydrated()
                        ->unique(Game::class, 'slug', ignoreRecord:true),

                    TextInput::make('summary')
                        ->required()
                        ->maxLength(255),
                    
                    FileUpload::make('thumbnail')
                        ->image()
                        ->directory('thumbnails')
                        ->preserveFilenames()
                        ->helperText('Recommended formats: JPEG or PNG. Recommended size: under 1 MB. Please use 3:4 Aspect Ratio (Horizontal : Vertical)'),

                    MarkdownEditor::make('description')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('games'),
                ])->columns(2),

                Section::make('Game Screenshots')->schema([
                    FileUpload::make('screenshots')
                        ->multiple()
                        ->directory('screenshots')
                        ->maxFiles(6)
                        ->reorderable()
                        ->preserveFilenames()
                        ->helperText('Uploads minimum 3 screenshots, maximum is set to 6 screenshots. Recommended formats: JPEG or PNG. Recommended size: under 1 MB each image. Please use 4:3 Aspect Ratio (Horizontal : Vertical)'),
                ]),

                Section::make('Game Associations')->schema([
                    Select::make('platform_id')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship('platform', 'name'),

                    Select::make('genres')
                        ->required()
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->relationship('genres', 'name'),
                ]),

                Section::make('Game Spesifications')->schema([
                    TextInput::make('developer')
                        ->label('Developer / Publisher')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('game_size')
                        ->required()
                        ->maxLength(255),
                    MarkdownEditor::make('requirement')
                        ->label('Game Minimum Spec Requirements')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('games'),
                    MarkdownEditor::make('howtoinstall')
                        ->label('How to install game guide / readme')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('games'),
                ]),

                Section::make('Meta')->schema([
                    TextInput::make('meta_title')
                        ->required()
                        ->maxLength(255),
                    MarkdownEditor::make('meta_keyword')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('games'),
                    MarkdownEditor::make('meta_description')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('games'),
                ]),

                Section::make('Game Links')->schema([
                    TextInput::make('link1')
                        ->placeholder('example: https://www.game-link.com')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('link2')
                        ->placeholder('example: https://www.game-link.com')
                        ->required()
                        ->maxLength(255),
                ]),

                Section::make('Status')->schema([
                    Toggle::make('is_active')
                        ->required()
                        ->default(true),
                    Toggle::make('is_featured')
                        ->required()
                        ->default(false),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('slug')
                    ->searchable(),

                TextColumn::make('platform.name')
                    ->sortable(),

                TextColumn::make('genres')
                    ->label('Genre')
                    ->sortable()
                    ->formatStateUsing(function ($record) {
                        // Access the genres relationship directly from the record
                        return $record->genres->isNotEmpty() 
                            ? $record->genres->pluck('name')->implode(', ') 
                            : 'No genres';
                    }),

                IconColumn::make('is_active')
                    ->boolean(),
                IconColumn::make('is_featured')
                    ->boolean(),
                
                TextColumn::make('link1')
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('link2')
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
            ])
            ->filters([
                SelectFilter::make('platform')
                    ->relationship('platform', 'name'),
                SelectFilter::make('genre')
                    ->multiple()
                    ->preload()
                    ->relationship('genres', 'name'),
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
