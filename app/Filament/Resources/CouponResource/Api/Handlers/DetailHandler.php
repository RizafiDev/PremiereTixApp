<?php

namespace App\Filament\Resources\CouponResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\CouponResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\CouponResource\Api\Transformers\CouponTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = CouponResource::class;


    /**
     * Show Coupon
     *
     * @param Request $request
     * @return CouponTransformer
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

        return new CouponTransformer($query);
    }
}
