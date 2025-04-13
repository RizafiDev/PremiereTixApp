<?php
namespace App\Filament\Resources\SeatResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Seat;

/**
 * @property Seat $resource
 */
class SeatTransformer extends JsonResource
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
