<?php

namespace App\Filament\Resources\FilmResource\Api\Handlers;

use App\Filament\Resources\FilmResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\FilmResource\Api\Transformers\FilmTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = FilmResource::class;

    public static bool $public = true;

    /**
     * Show Film with Genres
     *
     * @param Request $request
     * @return FilmTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->with('genres') // Tambahkan relasi genres
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new FilmTransformer($query);
    }
}
