<?php
namespace App\Filament\Resources\FilmResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\FilmResource;
use Illuminate\Routing\Router;


class FilmApiService extends ApiService
{
    protected static string | null $resource = FilmResource::class;

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
