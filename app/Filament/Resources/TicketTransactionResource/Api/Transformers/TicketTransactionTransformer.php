<?php
namespace App\Filament\Resources\TicketTransactionResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\TicketTransaction;

/**
 * @property TicketTransaction $resource
 */
class TicketTransactionTransformer extends JsonResource
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
