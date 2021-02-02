<?php

namespace App\Services\Data;

use App\Models\Property;

class ViewService
{
    /**
     * @return array
     */
    public function getSortingCountryAndCityList(): array
    {
        $countries = [];
        foreach (SettingService::COUNTRIES as $country => $cityList) {
            $countries[trans('countries.name.' . $country)] = $country;
        }
        ksort($countries);
        $countries = array_values($countries);

        $result = [];
        foreach ($countries as $country) {
            $cities = [];
            foreach (SettingService::COUNTRIES[$country] as $city) {
                $cities[trans('feeds/districts.city.' . $city . '.name')] = $city;
            }
            ksort($cities);
            $result[$country] = array_values($cities);
        }
        return $result;
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

    /**
     * @param Property $property
     * @return array
     */
    public function getPreviousAndNexLinks(Property $property): array
    {
        $properties = Property::where('country', $property->country)
            ->where('city', $property->city)
            ->where('district', $property->district)
            ->where('rooms', $property->rooms)
            ->get(['country', 'city', 'district', 'id'])
            ->keyBy('id')
            ->toArray();
        $ids = array_keys($properties);
        $position = array_search($property->id, $ids);
        return [
            'previous' => $position ? route('properties.show', $properties[$ids[$position - 1]]) : '',
            'next'     => isset($ids[$position + 1]) ? route('properties.show', $properties[$ids[$position + 1]]) : ''
        ];
    }
}
