<?php
namespace App\Filament\Resources\AppUserResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\AppUserResource;
use Illuminate\Routing\Router;


class AppUserApiService extends ApiService
{
    protected static string | null $resource = AppUserResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class,
            Handlers\LoginHandler::class,
        ];

    }
}
