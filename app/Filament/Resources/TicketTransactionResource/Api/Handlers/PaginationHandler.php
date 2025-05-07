<?php
namespace App\Filament\Resources\TicketTransactionResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\TicketTransactionResource;
use App\Filament\Resources\TicketTransactionResource\Api\Transformers\TicketTransactionTransformer;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = TicketTransactionResource::class;
    public static bool $public = true;

    public function handler()
    {
        $query = static::getEloquentQuery();
        
        // Get the appuser_id from request parameters
        $appuserId = request()->query('appuser_id');
        
        $query = QueryBuilder::for($query)
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? []);
            
        // Add filter for appuser_id if provided
        if ($appuserId) {
            $query->where('appuser_id', $appuserId);
        }
            
        $results = $query->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return TicketTransactionTransformer::collection($results);
    }
}