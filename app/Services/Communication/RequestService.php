<?php

namespace App\Services\Communication;

use Illuminate\Support\Facades\Http;

class RequestService
{

    public static function get(string $url)
    {
        !config('app.debug') || $url !== 'http://property.manyflats.com/export' ?: $url = storage_path('property') . '/test/export.json';
        $content = file_get_contents($url);
        $content = json_decode($content, true);
        return $content['data'];
    }

    public static function post(string $url, array $data)
    {
        return Http::post($url, $data)->body();
    }

    public static function getApiData(string $url, array $data = [], string $type = 'GET')
    {
        return $type == 'POST' ? self::post($url, $data) : self::get($url);
    }
}
