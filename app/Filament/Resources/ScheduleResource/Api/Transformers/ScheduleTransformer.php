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
        return [
            'id' => $this->id,
            'film_id' => $this->film_id,
            'cinema_id' => $this->cinema_id,
            'show_date' => $this->show_date,
            'show_time' => $this->show_time,
            'studio' => $this->studio,
            'price' => $this->price,
            'cinema' => [
                'id' => $this->cinema->id ?? null,
                'name' => $this->cinema->name ?? null,
                'address' => $this->cinema->address ?? null,
            ]
            ];
    }
}
