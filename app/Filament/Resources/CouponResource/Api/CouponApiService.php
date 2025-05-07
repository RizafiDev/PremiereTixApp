<?php
namespace App\Filament\Resources\CouponResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\CouponResource;
use Illuminate\Routing\Router;


class CouponApiService extends ApiService
{
    protected static string | null $resource = CouponResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
