<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FilmResource\Pages;
use App\Filament\Resources\FilmResource\RelationManagers;
use App\Models\Film;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FilmResource extends Resource
{
    protected static ?string $model = Film::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->required(),

            Forms\Components\DatePicker::make('release_date')
                ->label('Release Date')
                ->required(),

            Forms\Components\TextInput::make('rating')
                ->label('Rating')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('country')
                ->label('Country')
                ->required(),

                Forms\Components\Select::make('genre')
    ->label('Genre')
    ->relationship('genres', 'genre') // Menggunakan relasi langsung ke Genre
    ->multiple() // Bisa memilih lebih dari satu genre
    ->searchable() // Bisa mencari genre
    ->preload() // Memuat semua opsi langsung
    ->required(),
    
           

            Forms\Components\FileUpload::make('photo')
                ->image()
                ->label('Poster')
                ->required()
                ->disk('public'),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\ImageColumn::make('photo')->width(80)->height(130),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('release_date'),
                Tables\Columns\TextColumn::make('rating')->badge()->color('danger'),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\TextColumn::make('genres.genre')
    ->label('Genres')
    ->badge()
    ->separator(', '), // Menampilkan banyak genre dalam satu kolom
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFilms::route('/'),
            'create' => Pages\CreateFilm::route('/create'),
            'edit' => Pages\EditFilm::route('/{record}/edit'),
        ];
    }
}
