<?php
namespace App\Filament\Resources\GenreResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\GenreResource;
use App\Filament\Resources\GenreResource\Api\Requests\CreateGenreRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = GenreResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Genre
     *
     * @param CreateGenreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateGenreRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}