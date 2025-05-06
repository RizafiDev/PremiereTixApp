<?php

namespace App\Filament\Resources\TicketTransactionResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\TicketTransactionResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\TicketTransactionResource\Api\Transformers\TicketTransactionTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = TicketTransactionResource::class;
    public static bool $public = true;

    /**
     * Show TicketTransaction
     *
     * @param Request $request
     * @return TicketTransactionTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new TicketTransactionTransformer($query);
    }
}
