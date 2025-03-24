<?php
namespace App\Filament\Resources\GenreResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Genre;

/**
 * @property Genre $resource
 */
class GenreTransformer extends JsonResource
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
