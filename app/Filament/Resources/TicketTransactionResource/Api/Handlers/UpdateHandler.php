<?php
namespace App\Filament\Resources\TicketTransactionResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\TicketTransactionResource;
use App\Filament\Resources\TicketTransactionResource\Api\Requests\UpdateTicketTransactionRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = TicketTransactionResource::class;
    public static bool $public = true;
    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update TicketTransaction
     *
     * @param UpdateTicketTransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateTicketTransactionRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}