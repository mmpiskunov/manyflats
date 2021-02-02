<?php

namespace App\Services\Data;

use App\Models\Property;
use Illuminate\Support\Facades\Cache;

class StatService
{
    /**
     * @param Property $property
     * @return array
     */
    public function getPriceStatByRegion(Property $property): array
    {
        return Cache::remember(
            'StatService:getPriceStatByRegion:' . $property->id,
            3600,
            function () use ($property) {
                return Property::where('country', $property->country)
                    ->where('city', $property->city)
                    ->where('district', $property->district)
                    ->where('rooms', $property->rooms)
                    ->orderBy('price')
                    ->get()
                    ->keyBy('price')
                    ->keys()
                    ->toArray();
            }
        );
    }

    /**
     * @return array
     */
    public function getCountryPictures(): array
    {
        return Property::where('payback', '>', 0)
            ->orderBy('profit', 'desc')
            ->get(['id', 'country', 'city', 'district', 'profit', 'payback'])
            ->unique('country')
            ->keyBy('country')
            ->toArray();
    }
}
