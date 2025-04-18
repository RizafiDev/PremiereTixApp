<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketTransactionResource\Pages;
use App\Filament\Resources\TicketTransactionResource\RelationManagers;
use App\Models\TicketTransaction;
use App\Models\AppUser;
use App\Models\Schedule;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TicketTransactionResource extends Resource
{
    protected static ?string $model = TicketTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // form tidak diaktifkan
                // form deactived
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Customer')->sortable(),
                Tables\Columns\TextColumn::make('schedule.id')->label('Schedule'),
                Tables\Columns\TextColumn::make('gross_amount')->label('Amount')->money('IDR'),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'success' => 'success',
                    'pending' => 'warning',
                    'failed', 'expired' => 'danger',
                }),
                Tables\Columns\TextColumn::make('created_at')->label('Created')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListTicketTransactions::route('/'),
            'create' => Pages\CreateTicketTransaction::route('/create'),
            'edit' => Pages\EditTicketTransaction::route('/{record}/edit'),
        ];
    }
}
