<?php

namespace App\Services\Communication;

use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class ImportService
{
    const URL = 'http://property.manyflats.com/export';

    protected $feedService;

    public function __construct(FeedService $feedService)
    {
        $this->feedService = $feedService;
    }

    public function import()
    {
        $data = RequestService::getApiData(self::URL);
        $this->save($data);
    }

    /**
     * @param array $data
     */
    private function save(array $data)
    {
        $feedService = new FeedService;
        $now = Carbon::now();
        foreach ($data as $item) {
            $street = trim(preg_replace("/ [^ ]+$/sDu", "", $item['street']));
            $house = trim(str_replace($street, "", $item['street']));
            $count = Property::where('link', $item['link'])->count();
            if ($count) {
                Property::where('link', $item['link'])
                    ->update(['updated_at' => $now]);
            } else {
                $data = [
                    'country'    => $item['country'],
                    'city'       => $item['city'],
                    'district'   => $item['district'],
                    'street'     => $street,
                    'house'      => $house,
                    'floor'      => $item['floor'],
                    'floors'     => $item['floors'],
                    'rooms'      => $item['rooms'],
                    'space'      => $item['space'],
                    'price'      => $item['price'],
                    'price2m'    => $item['price2m'],
                    'rent'       => $item['rent'],
                    'rent2m'     => bcdiv($item['rent'], $item['space'], 2),
                    'payback'    => $item['payback'],
                    'profit'     => $item['profit'],
                    'latitude'   => $item['latitude'],
                    'longitude'  => $item['longitude'],
                    'link'       => $item['link'],
                    'search'     => $this->getSearchIndex($item),
                    'created_at' => Carbon::parse($item['updated']),
                    'updated_at' => $now
                ];
                $property = Property::create($data);
                $data['property_id'] = $property->id;
                $feedService->add($data);
            }
        }
    }

    /**
     * @return string
     */
    private function getSearchIndex(array $item): string
    {
        $data = [];
        foreach (config('localized-routes.supported-locales') as $language) {
            $data[] = $this->getSearchLanguageIndex($item, $language);
        }
        return Str::lower(implode(' ', $data));
    }

    /**
     * @param string $language
     * @return string
     */
    private function getSearchLanguageIndex(array $data, string $language): string
    {
        App::setLocale($language);
        return $this->feedService->translateContent(trans('properties/search.index'), $data);
    }
}
