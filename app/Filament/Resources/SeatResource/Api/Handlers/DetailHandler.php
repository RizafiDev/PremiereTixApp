<?php

namespace App\Filament\Resources\SeatResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\SeatResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\SeatResource\Api\Transformers\SeatTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = SeatResource::class;


    /**
     * Show Seat
     *
     * @param Request $request
     * @return SeatTransformer
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

        return new SeatTransformer($query);
    }
}
