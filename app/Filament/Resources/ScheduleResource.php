<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduleResource\Pages;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ScheduleResource extends Resource
{
    protected static ?string $model = Schedule::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('film_id')
                ->label('Film')
                ->relationship('film', 'title')
                ->required(),

            Forms\Components\Select::make('cinema_id')
                ->label('Cinema')
                ->relationship('cinema', 'name')
                ->required(),

            Forms\Components\DatePicker::make('show_date')
                ->label('Show Date')
                ->required(),

            Forms\Components\TimePicker::make('show_time')
                ->label('Show Time')
                ->required(),

            Forms\Components\TextInput::make('studio')
                ->label('Studio')
                ->required(),
            Forms\Components\TextInput::make('price')
                ->label('Price')
                ->required(),
                
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id')
                ->label('ID')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('film.title')
                ->label('Film')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('cinema.name')
                ->label('Cinema')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('show_date')
                ->label('Date')
                ->date()
                ->sortable(),

            Tables\Columns\TextColumn::make('show_time')
                ->label('Time')
                ->time()
                ->sortable(),

            Tables\Columns\TextColumn::make('studio')
                ->label('Studio')
                ->sortable(),
            Tables\Columns\TextColumn::make('price')
                ->label('Price')
                ->sortable()
                ->money('idr', true)
                ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.')),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedule::route('/create'),
            'edit' => Pages\EditSchedule::route('/{record}/edit'),
        ];
    }
}
