<?php
namespace App\Filament\Resources\CinemaResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\CinemaResource;
use Illuminate\Routing\Router;


class CinemaApiService extends ApiService
{
    protected static string | null $resource = CinemaResource::class;

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
