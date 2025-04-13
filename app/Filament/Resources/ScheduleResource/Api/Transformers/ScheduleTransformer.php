<?php
namespace App\Filament\Resources\ScheduleResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Schedule;

/**
 * @property Schedule $resource
 */
class ScheduleTransformer extends JsonResource
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
