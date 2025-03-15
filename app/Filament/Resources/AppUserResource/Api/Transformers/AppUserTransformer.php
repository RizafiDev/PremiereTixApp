<?php
namespace App\Filament\Resources\AppUserResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\AppUser;

/**
 * @property AppUser $resource
 */
class AppUserTransformer extends JsonResource
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
