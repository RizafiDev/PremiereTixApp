<?php
namespace App\Filament\Resources\TicketTransactionResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\TicketTransactionResource;
use App\Filament\Resources\TicketTransactionResource\Api\Requests\CreateTicketTransactionRequest;
use Midtrans\Config;
use Midtrans\Snap;


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

    // Set expires_at 5 menit ke depan
    $model->fill([
        ...$request->all(),
        'expires_at' => now()->addMinutes(5),
    ]);
    $model->save();

    // Midtrans config
    Config::$serverKey = config('services.midtrans.server_key');
    Config::$isProduction = config('services.midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $snapPayload = [
        'transaction_details' => [
            'order_id' => $model->order_id,
            'gross_amount' => (int) $model->gross_amount,
        ],
        'customer_details' => [
            'first_name' => $request->user()->name ?? 'Guest',
            'email' => $request->user()->email ?? 'guest@example.com',
        ],
    ];

    try {
        $snapToken = Snap::getSnapToken($snapPayload);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to create Snap Token',
            'error' => $e->getMessage(),
        ], 500);
    }

    return response()->json([
        'message' => 'Successfully created transaction',
        'data' => $model,
        'snap_token' => $snapToken,
    ]);
}

    
}