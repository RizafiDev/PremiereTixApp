<?php
namespace App\Filament\Resources\TicketTransactionResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\TicketTransactionResource;
use App\Filament\Resources\TicketTransactionResource\Api\Requests\CreateTicketTransactionRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = TicketTransactionResource::class;
    public static bool $public = true;
    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create TicketTransaction
     *
     * @param CreateTicketTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateTicketTransactionRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}