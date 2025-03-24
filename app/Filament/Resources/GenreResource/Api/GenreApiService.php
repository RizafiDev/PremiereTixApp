<?php
namespace App\Filament\Resources\GenreResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\GenreResource;
use Illuminate\Routing\Router;


class GenreApiService extends ApiService
{
    protected static string | null $resource = GenreResource::class;

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
