<?php
namespace App\Filament\Resources\CouponResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Coupon;

/**
 * @property Coupon $resource
 */
class CouponTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
