<?php
namespace App\Filament\Resources\SeatResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\SeatResource;
use Illuminate\Routing\Router;


class SeatApiService extends ApiService
{
    protected static string | null $resource = SeatResource::class;

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
