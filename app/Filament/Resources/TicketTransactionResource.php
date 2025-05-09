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
use Illuminate\Support\Facades\Storage;


class TicketTransactionResource extends Resource
{
    protected static ?string $model = TicketTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('appuser.name')->label('Customer')->sortable(),
                Tables\Columns\TextColumn::make('appuser.email')->label('Email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('seats')->label('Seat')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('schedule.id')->label('Schedule'),
                Tables\Columns\TextColumn::make('schedule.film.title')->label('Film')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('schedule.cinema.name')->label('Cinema')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('schedule.show_date')->label('Show Date')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('schedule.show_time')->label('Show Time')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('gross_amount')->label('Amount')->money('IDR'),
                Tables\Columns\TextColumn::make('status')->badge()->color(fn (string $state): string => match ($state) {
                    'success' => 'success',
                    'pending' => 'warning',
                    'failed', 'expired' => 'danger',
                }),
                Tables\Columns\TextColumn::make('created_at')->label('Created')->dateTime(),
                Tables\Columns\TextColumn::make('expires_at')->label('Expired'),
                Tables\Columns\ImageColumn::make('qr_code_path')
                ->label('QR Code')
                ->disk('public')
                ->visibility('public')
                ->width(100)
                ->height(100)
                ->url(fn ($record) => Storage::disk('public')->url($record->qr_code_path))
                ->openUrlInNewTab(false)
                ->extraAttributes([
                    'download' => '', // agar browser download otomatis
                ]),
            
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
            'index' => Pages\ListTicketTransactions::route('/'),
            'create' => Pages\CreateTicketTransaction::route('/create'),
            'edit' => Pages\EditTicketTransaction::route('/{record}/edit'),
        ];
    }
}
