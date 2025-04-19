<?php
namespace App\Filament\Resources\SeatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\SeatResource;
use App\Filament\Resources\SeatResource\Api\Requests\UpdateSeatRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{seat_code}';
    public static string | null $resource = SeatResource::class;
    public static bool $public = true;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Update Seat
     *
     * @param UpdateSeatRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateSeatRequest $request)
    {
        $seatCode = $request->route('seat_code');
        $scheduleId = $request->input('schedule_id');

        // Cari kursi berdasarkan schedule_id dan seat_code
        $model = static::getModel()::where('seat_code', $seatCode)
            ->where('schedule_id', $scheduleId)
            ->first();

        if (!$model) {
            return static::sendNotFoundResponse("Seat not found for the given schedule_id and seat_code.");
        }

        $model->fill($request->all());
        $model->save();

        return static::sendSuccessResponse($model, "Successfully updated seat.");
    }
}