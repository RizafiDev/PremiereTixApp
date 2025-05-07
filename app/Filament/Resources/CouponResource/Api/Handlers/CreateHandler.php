<?php
namespace App\Filament\Resources\CouponResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\CouponResource;
use App\Filament\Resources\CouponResource\Api\Requests\CreateCouponRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = CouponResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Coupon
     *
     * @param CreateCouponRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateCouponRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}