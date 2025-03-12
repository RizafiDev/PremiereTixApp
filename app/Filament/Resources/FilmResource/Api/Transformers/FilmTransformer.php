<?php
namespace App\Filament\Resources\FilmResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Film;

/**
 * @property Film $resource
 */
class FilmTransformer extends JsonResource
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
