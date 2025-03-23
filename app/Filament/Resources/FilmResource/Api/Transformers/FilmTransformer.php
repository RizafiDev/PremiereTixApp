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
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'release_date' => $this->resource->release_date,
            'rating' => $this->resource->rating,
            'country' => $this->resource->country,
            'photo' => $this->resource->photo,
            'playing' => $this->resource->playing,
            'genres' => $this->resource->genres->map(function ($genre) {
                return [
                    'id' => $genre->id,
                    'name' => $genre->name,
                    'color' => $genre->color,
                ];
            }),
        ];
    }
}
