<?php

namespace App\Filament\Resources\CinemaResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\CinemaResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\CinemaResource\Api\Transformers\CinemaTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = CinemaResource::class;


    /**
     * Show Cinema
     *
     * @param Request $request
     * @return CinemaTransformer
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

        return new CinemaTransformer($query);
    }
}
