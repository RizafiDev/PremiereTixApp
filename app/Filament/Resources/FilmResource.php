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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Title')->required(),
                Forms\Components\Textarea::make('description')->label('Description')->required(),
                Forms\Components\Datepicker::make('release_date')->label('Release Date')->required(),
                Forms\Components\TextInput::make('rating')->label('Rating')->required(),
                Forms\Components\TextInput::make('country')->label('Country')->required(),
                Forms\Components\TextInput::make('genre')->label('Genre')->required(),
                Forms\Components\FileUpload::make('photo')->label('Photo')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                $table->column('title')->primary(),
                $table->column('description'),
                $table->column('release_date'),
                $table->column('rating'),
                $table->column('country'),
                $table->column('genre'),
                $table->column('photo'),
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
