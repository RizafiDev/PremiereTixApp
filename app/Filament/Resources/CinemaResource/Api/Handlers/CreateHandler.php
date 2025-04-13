<?php
namespace App\Filament\Resources\CinemaResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\CinemaResource;
use App\Filament\Resources\CinemaResource\Api\Requests\CreateCinemaRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = CinemaResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Cinema
     *
     * @param CreateCinemaRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateCinemaRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}