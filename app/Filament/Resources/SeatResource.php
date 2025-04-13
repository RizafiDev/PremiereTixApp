<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeatResource\Pages;
use App\Models\Seat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SeatResource extends Resource
{
    protected static ?string $model = Seat::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('schedule_id')
                ->label('Schedule')
                ->relationship('schedule', 'id')
                ->required(),

            Forms\Components\TextInput::make('seat_code')
                ->label('Seat Code')
                ->required()
                ->maxLength(10),

            Forms\Components\Toggle::make('is_booked')
                ->label('Is Booked')
                ->default(false),

            Forms\Components\Select::make('booked_by')
                ->label('Booked By')
                ->relationship('user', 'name')
                ->searchable()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('schedule.id')
                ->label('Schedule'),

            Tables\Columns\TextColumn::make('seat_code')
                ->label('Seat Code')
                ->sortable()
                ->searchable(),

            Tables\Columns\IconColumn::make('is_booked')
                ->label('Booked')
                ->boolean(),

            Tables\Columns\TextColumn::make('user.name')
                ->label('Booked By')
                ->sortable()
                ->searchable(),
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
            'index' => Pages\ListSeats::route('/'),
            'create' => Pages\CreateSeat::route('/create'),
            'edit' => Pages\EditSeat::route('/{record}/edit'),
        ];
    }
}
