<?php
namespace App\Filament\Resources\TicketTransactionResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\TicketTransactionResource;
use Illuminate\Routing\Router;


class TicketTransactionApiService extends ApiService
{
    protected static string | null $resource = TicketTransactionResource::class;

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
