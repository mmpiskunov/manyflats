<?php

namespace App\Services\Communication;

use App\Models\Feed;
use App\Models\Property;
use App\Services\Content\VariatorService;
use App\Services\Data\SettingService;
use App\Services\Image\ImageCaptioningService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class FeedService
{
    const LANGUAGES = ['ru', 'en'];

    const FEED_LABEL_LIST = [
        'in_city_district',
        'in_district',
        'country_name',
        'country_prep',
        'city_name',
        'district_name',
        'street',
        'in_floors',
        'for_payback',
        'rooms_amount',
        'rooms_value_short',
        'rooms_value',
        'floor_amount',
        'floor_value',
        'floors_amount',
        'space_amount',
        'price_amount',
        'price_value',
        'rent_amount',
        'rent_value',
        'profit_amount',
        'profit_value',
        'payback_amount',
        'project_url'
    ];

    protected $variator;
    protected $imageCaptioningService;
    protected $language = 'ru';
    protected $data = [];

    public function __construct()
    {
        $this->variator = new VariatorService;
        $this->imageCaptioningService = new ImageCaptioningService;
    }

    public function add(array $data)
    {
        $this->data = $data;
        $this->data['address'] = trim($this->data['street'] . ' ' . $this->data['house']);

        //if ($this->hasImage()) {
        foreach (self::LANGUAGES as $this->language) {
            App::setLocale($this->language);
            $this->data['feed_id'] = $this->getFeedId();
            $this->exist() ?: $this->store();
        }
        //}
    }

    public function getText(array $data, string $type = 'content'): string
    {
        $language = app()->getLocale();
        $key = 'properties:' . $language . ':show:' . $type . ':' . $data['link'];
        if (Cache::has($key)) {
            $content = Cache::get($key);
        } else {
            $this->data = $data;
            $this->data['address'] = trim($this->data['street'] . ' ' . $this->data['house']);
            $content = $this->getContent($type);
            Cache::put($key, $content, now()->addDays(31));
        }
        return $content;
    }

    /**
     * @param string $content
     * @param array $data
     * @return string
     */
    public function translateContent(string $content, array $data): string
    {
        $this->data = $data;
        $content = $this->variator->variate($content);
        return $this->replaceValues($content);
    }

    /**
     * @param string $language
     * @param string $channel
     * @return mixed
     */
    public function getRandom(string $language, string $channel)
    {
        if ($channel) {
            do {
                $items = $this->getOneRandom($language, $channel);
            } while (empty($items));
        } else {
            $items = $this->getEasyRandom($language);
        }
        return $items;
    }

    /**
     * @param string $language
     * @param string $channel
     * @return mixed
     */
    private function getOneRandom(string $language, string $channel)
    {
        $country = $this->getCurrentCountry($language, $channel);
        $links = $this->getUsedLinksForChannel($language, $channel);
        $feeds = Feed::where('language', $language);
        $feeds = $feeds->leftJoin('properties', 'feeds.property_id', '=', 'properties.id')
            ->where('properties.country', '=', $country)
            ->where('properties.payback', '>', 5)
            ->whereNotIn('feeds.link', $links)
            ->orderBy('properties.payback')
            ->first(); // $feeds->get()->random(1) OR ->take(1)
        if (!empty($feeds)) {
            $this->addUsedLinkForChannel($language, $channel, $feeds['link']);
        }
        return !empty($feeds) ? $this->addPageLink($feeds) : null;
    }

    /**
     * @param string $language
     * @return mixedp
     */
    private function getEasyRandom(string $language)
    {
        $feeds = Feed::where('language', $language)
            ->get();
        empty($feeds->count()) ?: $feeds = $feeds->random(1);
        $feeds = $feeds->toArray();

        return !empty($feeds[0]) ? $this->addPageLink($feeds[0]) : null;
    }

    private function addPageLink($item)
    {
        $property = Property::find($item['property_id']);
        $item['page_link'] = route('properties.show', ['country' => $property->country, 'city' => $property->city, 'district' => $property->district, 'id' => $item['property_id']]);
        return $item;
    }

    public function demo(string $language, array $data, int $contentId): string
    {
        App::setLocale($language);
        $this->data = $data;
        return '<b>' . $this->getContent('title') . '</b>' . $this->getContent('content', $contentId);
    }

    public function verify(string $language): array
    {
        $items = Property::where(
            function ($query) {
                $query->where('payback', '<', 15)
                    ->orWhere('country', 'germany')
                    ->orWhere('city', 'tartu');
            })
            ->orderBy('country')
            ->orderBy('city')
            ->orderBy('profit', 'DESC')
            //->orderBy('district')
            //->orderBy('street')
            //->orderBy('house')
            ->get();

        $notFoundPictures = [];
        foreach ($items as $item) {
            $address = trim($item->street . ' ' . $item->house);
            $fileName = $this->imageCaptioningService->translit($address);
            $houseImage = storage_path('property') . '/house/' . strtolower($item->country) . '/' . strtolower($item->city) . '/' . substr($fileName, 0, 1) . '/' . $fileName . '.jpg';
            if (!is_file($houseImage)) {
                $notFoundPictures[] = [
                    'country'  => $item->country,
                    'city'     => $item->city,
                    'district' => $item->district,
                    'address'  => $address,
                    'namefile' => $fileName . '.jpg',
                    'payback'  => $item->payback . ' years',
                    'link'     => $item->link,
                ];
            }
        }

        return $notFoundPictures;
    }

    public function getPictureLink(array $data, $language = ''): string
    {
        $this->data = $data;
        $this->data['address'] = trim($this->data['street'] . ' ' . $this->data['house']);
        $language ?: $language = app()->getLocale();
        //if ($this->hasImage()) {
        $link = route('feed.property.picture', ['language' => $language, 'id' => $data['id']]);
        //}
        return $link ?? '';
    }

    private function store(): void
    {
        $data = [
            'feed_id'     => $this->data['feed_id'],
            'property_id' => $this->data['property_id'],
            'language'    => $this->language,
            'title'       => $this->getContent('topic'),
            'content'     => $this->getContent('content'),
            'image'       => route('feed.property.picture', ['language' => $this->language, 'id' => $this->data['property_id']]),
            'link'        => $this->data['link']
        ];
        Feed::create($data);
    }

    /**
     * @return bool
     */
    private function exist(): bool
    {
        return Feed::where('feed_id', $this->data['feed_id'])->count() > 0;
    }

    /**
     * @param string $language
     * @param string $channel
     * @return string
     */
    private function getCurrentCountry(string $language, string $channel): string
    {
        $key = 'feed:country:' . $language . ':' . $channel;
        $countries = SettingService::getCountries();
        if (Cache::has($key)) {
            $countryId = Cache::pull($key);
            $countryId++;
            $countryId < count($countries) ?: $countryId = 0;
        } else {
            $countryId = array_rand($countries);
        }
        Cache::put($key, $countryId, now()->addDay());
        return $countries[$countryId];
    }

    /**
     * @param string $language
     * @param string $channel
     * @param string $link
     */
    private function addUsedLinkForChannel(string $language, string $channel, string $link): void
    {
        $key = 'feed:links:' . $language . ':' . $channel;
        $links = $this->getUsedLinksForChannel($language, $channel);
        $links[] = $link;
        !Cache::has($key) ?: Cache::forget($key);
        Cache::put($key, $links, now()->addDays(31));
    }

    /**
     * @param string $language
     * @param string $channel
     * @return array
     */
    private function getUsedLinksForChannel(string $language, string $channel): array
    {
        $key = 'feed:links:' . $language . ':' . $channel;
        return Cache::has($key) ? Cache::get($key) : [];
    }

    /**
     * @param string $name
     * @param int|null $contentId
     * @return string
     */
    private function getContent(string $name, ?int $contentId = null): string
    {
        $language = app()->getLocale();
        $maxContentVariants = $language == 'ru' ? 10 : 5;
        $max = $name == 'content' ? $maxContentVariants : 1;
        !empty($contentId) ?: $contentId = $this->randomNumber($max);
        $content = trans('feeds/posts.' . $name . $contentId);
        $content = $this->variator->variate($content);
        $content = $this->replaceValues($content);
        return $content;
    }

    /**
     * @param string $content
     * @return string
     */
    private function replaceValues(string $content): string
    {
        foreach (self::FEED_LABEL_LIST as $name) {
            strpos($content, ':' . $name) === false ?: $content = str_replace(':' . $name, $this->getTransValue($name), $content);
        }
        return $content;
    }

    /**
     * @param string $name
     * @return string
     */
    private function getTransValue(string $name): string
    {
        $language = app()->getLocale();
        $replace = '';
        if ($name === 'in_city_district') {
            empty($this->data['district']) || empty($this->data['city']) ?: $replace = trans('feeds/districts.where_with_city.' . strtolower($this->data['city']) . '.' . strtolower($this->data['district']));
        } elseif ($name === 'in_district') {
            empty($this->data['district']) || empty($this->data['city']) ?: $replace = trans('feeds/districts.where.' . strtolower($this->data['city']) . '.' . strtolower($this->data['district']));
        } elseif ($name === 'country_name') {
            empty($this->data['country']) ?: $replace = trans('countries.name.' . strtolower($this->data['country']));
        } elseif ($name === 'country_prep') {
            empty($this->data['country']) ?: $replace = trans('countries.prep.' . strtolower($this->data['country']));
        } elseif ($name === 'city_name') {
            empty($this->data['city']) ?: $replace = trans('feeds/districts.city.' . strtolower($this->data['city']) . '.name');
        } elseif ($name === 'district_name') {
            empty($this->data['district']) ?: $replace = trans('feeds/districts.city.' . strtolower($this->data['city']) . '.' . $this->data['district']);
        } elseif ($name === 'street') {
            empty($this->data['street']) ?: $replace = $this->data['street'];
        } elseif ($name === 'rooms_amount') {
            empty($this->data['rooms']) ?: $replace = $this->data['rooms'];
        } elseif ($name === 'rooms_value_short') {
            empty($this->data['rooms']) ?: $replace = $this->data['rooms'] . trans('feeds/posts.rooms_short');
        } elseif ($name === 'rooms_value') {
            empty($this->data['rooms']) ?: $replace = trans('feeds/posts.in_numbers.' . $this->data['rooms']);
        } elseif ($name === 'in_floors') {
            empty($this->data['floors']) ?: $replace = trans('feeds/posts.in_numbers.' . $this->data['floors']);
        } elseif ($name === 'for_payback') {
            if (!empty($this->data['payback'])) {
                $value = $this->data['payback'] == (int)$this->data['payback'] ? (int)$this->data['payback'] : 2;
                $replace = $this->removeExtraZeros($this->data['payback']) . ' ' . trans('feeds/posts.for_years.' . $value);
            }
        } elseif ($name === 'floor_amount') {
            empty($this->data['floor']) ?: $replace = $this->data['floor'];
        } elseif ($name === 'floor_value') {
            empty($this->data['floor']) ?: $replace = trans('feeds/posts.ordinal_numbers' . floor(rand(1, 2.999)) . '.' . $this->data['rooms']);
        } elseif ($name === 'floors_amount') {
            empty($this->data['floors']) ?: $replace = $this->data['floors'];
        } elseif ($name === 'space_amount') {
            empty($this->data['space']) ?: $replace = $this->removeExtraZeros($this->data['space']);
        } elseif ($name === 'price_amount') {
            empty($this->data['price']) ?: $replace = $this->removeExtraZeros($this->data['price']);
        } elseif ($name === 'price_value') {
            empty($this->data['price']) ?: $replace = $this->formatMoneyValue($this->data['price'], 0);
        } elseif ($name === 'rent_amount') {
            empty($this->data['rent']) ?: $replace = $this->removeExtraZeros($this->data['rent']);
        } elseif ($name === 'rent_value') {
            empty($this->data['rent']) ?: $replace = $this->formatMoneyValue($this->data['rent'], 0);
        } elseif ($name === 'profit_amount') {
            empty($this->data['profit']) ?: $replace = $this->removeExtraZeros($this->data['profit']);
        } elseif ($name === 'profit_value') {
            empty($this->data['profit']) ?: $replace = $this->removeExtraZeros($this->data['profit']) . '%';
        } elseif ($name === 'payback_amount') {
            empty($this->data['payback']) ?: $replace = $this->removeExtraZeros($this->data['payback']);
        } elseif ($name === 'project_url') {
            $replace = 'manyflats.com';
        }
        return $replace;
    }

    private function formatMoneyValue($value, int $decimals): string
    {
        $language = app()->getLocale();
        if ($language == 'ru') {
            $value = $this->removeExtraZeros($value) . trans('currencies.euro' . $this->randomNumber(2));
        } else {
            $value = trans('currencies.euro' . $this->randomNumber(2)) . $this->removeExtraZeros(number_format($value, $decimals, '.', ','));
        }
        return $value;
    }

    /**
     * @param int $max
     * @return int
     */
    private function randomNumber(int $max): int
    {
        return floor(rand(1, $max + 0.999));
    }

    /**
     * @return bool
     */
    private function hasImage(): bool
    {
        $fileName = $this->imageCaptioningService->translit($this->data['address']);
        $houseImage = storage_path('property')
            . '/house/'
            . strtolower($this->data['country'])
            . '/' . strtolower($this->data['city'])
            . '/' . substr($fileName, 0, 1)
            . '/' . $fileName . '.jpg';
        return is_file($houseImage);
    }

    /**
     * @return string
     */
    private function getFeedId(): string
    {
        return md5($this->language
            . $this->data['country']
            . $this->data['city']
            . $this->data['district']
            . $this->data['street']
            . $this->data['house']
            . $this->data['floor']
            . $this->data['floors']
            . $this->data['rooms']
            . $this->data['space']
            . $this->data['link']);
    }

    /**
     * @param $value
     * @return string
     */
    private function removeExtraZeros($value): string
    {
        $language = app()->getLocale();
        $value = preg_replace("/(\.[1-9])0$/sD", "\\1", "$value");
        $value = preg_replace("/\.0{1,2}$/sD", "", $value);
        return $language == 'ru' ? str_replace('.', ',', "$value") : trim($value);
    }
}
