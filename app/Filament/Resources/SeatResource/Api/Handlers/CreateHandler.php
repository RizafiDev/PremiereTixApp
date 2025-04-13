<?php
namespace App\Filament\Resources\SeatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\SeatResource;
use App\Filament\Resources\SeatResource\Api\Requests\CreateSeatRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = SeatResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Seat
     *
     * @param CreateSeatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateSeatRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}