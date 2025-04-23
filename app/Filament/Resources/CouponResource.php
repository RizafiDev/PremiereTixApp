<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('coupon_banner_path')
                ->label('Banner')
                ->image()
                ->disk('public')
                ->visibility('public'),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('snk')
                    ->label('SNK')
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->label('Code')
                    ->required()
                    ->unique('coupons', 'code'),

                Forms\Components\TextInput::make('discount')
                    ->label('Discount')
                    ->type('number')
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                ->label('Active')
                ->default(true),

                Forms\Components\DateTimePicker::make('expired_at')
                    ->label('Expired At')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->disabledClick(),
                Tables\Columns\ImageColumn::make('coupon_banner_path'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),
                Tables\Columns\TextColumn::make('snk')
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->searchable()
                    ->disabledClick()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active')
                    ->disabledClick()
                    ->sortable(),

                Tables\Columns\TextColumn::make('expired_at')
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
