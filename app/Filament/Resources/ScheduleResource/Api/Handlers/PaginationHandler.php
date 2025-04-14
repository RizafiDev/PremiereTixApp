<?php

namespace App\Filament\Resources\ScheduleResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Resources\ScheduleResource;
use App\Filament\Resources\ScheduleResource\Api\Transformers\ScheduleTransformer;

class PaginationHandler extends Handlers
{
    public static string | null $uri = '/';
    public static string | null $resource = ScheduleResource::class;
    public static bool $public = true;

    /**
     * List of Schedule
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler(Request $request)
    {
        $query = static::getEloquentQuery();

        $schedules = QueryBuilder::for($query->with(['cinema']))
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate($request->query('per_page', 15))
            ->appends($request->query());

        return ScheduleTransformer::collection($schedules);
    }
}
