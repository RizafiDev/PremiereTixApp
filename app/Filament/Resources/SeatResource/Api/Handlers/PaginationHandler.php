<?php
namespace App\Filament\Resources\SeatResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\SeatResource;
use App\Filament\Resources\SeatResource\Api\Transformers\SeatTransformer;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = SeatResource::class;
    public static bool $public = true;

    public function handler()
    {
        $query = static::getEloquentQuery();
        
        // Get schedule_id from request parameters
        $scheduleId = request()->query('schedule_id');
        
        $query = QueryBuilder::for($query)
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? []);
            
        // Add filter for schedule_id if provided
        if ($scheduleId) {
            $query->where('schedule_id', $scheduleId);
        }
            
        $results = $query->get();

        return SeatTransformer::collection($results);
    }
}