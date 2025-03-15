<?php

namespace App\Filament\Resources\AppUserResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\AppUserResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\AppUserResource\Api\Transformers\AppUserTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = AppUserResource::class;


    /**
     * Show AppUser
     *
     * @param Request $request
     * @return AppUserTransformer
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

        return new AppUserTransformer($query);
    }
}
