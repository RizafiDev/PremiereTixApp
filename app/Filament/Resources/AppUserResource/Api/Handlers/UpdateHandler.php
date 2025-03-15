<?php
namespace App\Filament\Resources\AppUserResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\AppUserResource;
use App\Filament\Resources\AppUserResource\Api\Requests\UpdateAppUserRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = AppUserResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update AppUser
     *
     * @param UpdateAppUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateAppUserRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}