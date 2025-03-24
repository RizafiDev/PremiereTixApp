<?php

namespace App\Filament\Resources\GenreResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\GenreResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\GenreResource\Api\Transformers\GenreTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = GenreResource::class;
    


    /**
     * Show Genre
     *
     * @param Request $request
     * @return GenreTransformer
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

        return new GenreTransformer($query);
    }
}
