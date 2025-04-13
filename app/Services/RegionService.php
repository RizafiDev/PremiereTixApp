<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RegionService
{
    protected $baseUrl = 'http://www.emsifa.com/api-wilayah-indonesia/api';

    public function getProvinces()
    {
        return Cache::remember('provinces', now()->addDays(30), function () {
            $response = Http::get("{$this->baseUrl}/provinces.json");
            return $response->successful() ? $response->json() : [];
        });
    }

    public function getCities($provinceId)
    {
        return Cache::remember("cities_{$provinceId}", now()->addDays(30), function () use ($provinceId) {
            $response = Http::get("{$this->baseUrl}/regencies/{$provinceId}.json");
            return $response->successful() ? $response->json() : [];
        });
    }
}