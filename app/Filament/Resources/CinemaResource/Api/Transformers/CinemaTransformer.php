<?php
namespace App\Filament\Resources\CinemaResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Cinema;

/**
 * @property Cinema $resource
 */
class CinemaTransformer extends JsonResource
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
