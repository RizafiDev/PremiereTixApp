<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CinemaResource\Pages;
use App\Filament\Resources\CinemaResource\RelationManagers;
use App\Models\Cinema;
use App\Services\RegionService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CinemaResource extends Resource
{
    protected static ?string $model = Cinema::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        $regionService = new RegionService();
        
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('Address')
                    ->required(),
                Forms\Components\Select::make('province')
                    ->label('Province')
                    ->options(function () use ($regionService) {
                        $provinces = $regionService->getProvinces();
                        return collect($provinces)->pluck('name', 'id')->toArray();
                    })
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        $set('city', null);
                    })
                    ->required(),
                Forms\Components\Select::make('city')
                    ->label('City')
                    ->options(function (Forms\Get $get) use ($regionService) {
                        $provinceId = $get('province');
                        if (!$provinceId) {
                            return [];
                        }
                        
                        $cities = $regionService->getCities($provinceId);
                        return collect($cities)->pluck('name', 'id')->toArray();
                    })
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $regionService = new RegionService();
        $provinces = collect($regionService->getProvinces())->keyBy('id');
        
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->disabledClick()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),
                Tables\Columns\TextColumn::make('province')
                    ->label('Province')
                    ->formatStateUsing(function ($state) use ($provinces) {
                        return $provinces[$state]['name'] ?? $state;
                    })
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city')
                    ->label('City')
                    ->formatStateUsing(function ($state, Cinema $record) use ($regionService) {
                        if (!$record->province) {
                            return $state;
                        }
                        
                        $cities = collect($regionService->getCities($record->province))->keyBy('id');
                        return $cities[$state]['name'] ?? $state;
                    })
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),
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
            'index' => Pages\ListCinemas::route('/'),
            'create' => Pages\CreateCinema::route('/create'),
            'edit' => Pages\EditCinema::route('/{record}/edit'),
        ];
    }
}