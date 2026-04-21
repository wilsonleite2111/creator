<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FichaResource\Pages;
use App\Filament\Resources\FichaResource\RelationManagers;
use App\Models\Ficha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FichaResource extends Resource
{
    protected static ?string $model = Ficha::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('raca_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('tendencia_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nome_personagem')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('nome_jogador')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('divindade')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('tamanho')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('idade')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sexo')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('altura')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('peso')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('olhos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cabelos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pele')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('raca_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tendencia_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nome_personagem')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nome_jogador')
                    ->searchable(),
                Tables\Columns\TextColumn::make('divindade')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tamanho')
                    ->searchable(),
                Tables\Columns\TextColumn::make('idade')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sexo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('altura')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('peso')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('olhos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cabelos')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pele')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListFichas::route('/'),
            'create' => Pages\CreateFicha::route('/create'),
            'edit' => Pages\EditFicha::route('/{record}/edit'),
        ];
    }    
}
