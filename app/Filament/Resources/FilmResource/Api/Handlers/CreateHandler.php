<?php
namespace App\Filament\Resources\FilmResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\FilmResource;
use App\Filament\Resources\FilmResource\Api\Requests\CreateFilmRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = FilmResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Film
     *
     * @param CreateFilmRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateFilmRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}