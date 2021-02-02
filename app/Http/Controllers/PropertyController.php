<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Services\Data\StatService;
use App\Services\Communication\FeedService;
use App\Services\Data\ViewService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
     const NUMBER_PER_PAGE = 8;

    protected $feedService;
    protected $property;
    protected $statService;
    protected $viewService;

    public function __construct(FeedService $feedService, Property $property, StatService $statService, ViewService $viewService)
    {
        $this->feedService = $feedService;
        $this->property = $property;
        $this->statService = $statService;
        $this->viewService = $viewService;
    }

    /**
     * Display a listing of properties.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $input = $request->except('_token');
        $data = $this->getList($input);
        return view('properties.list', $data);
    }

    /**
     * @param string $country
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function country(string $country, Request $request)
    {
        $input = $request->except('_token');
        $input['country'] = $country;
        $data = $this->getList($input);
        $data['country'] = $country;
        $data['title'] = trans('properties/list.title') . ': ' . trans('countries.name.' . $country);
        return view('properties.list', $data);
    }

    /**
     * @param string $country
     * @param string $city
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function city(string $country, string $city, Request $request)
    {
        $input = $request->except('_token');
        $input['country'] = $country;
        $input['city'] = $city;
        $data = $this->getList($input);
        $data['country'] = $country;
        $data['city'] = $city;
        $data['title'] = trans('properties/list.title') . ': ' . trans('countries.name.' . $country) . ', ' . trans('feeds/districts.city.' . $city . '.name');
        return view('properties.list', $data);
    }

    /**
     * @param string $country
     * @param string $city
     * @param string $district
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function district(string $country, string $city, string $district, Request $request)
    {
        $input = $request->except('_token');
        $input['country'] = $country;
        $input['city'] = $city;
        $input['district'] = $district;
        $data = $this->getList($input);
        $data['country'] = $country;
        $data['city'] = $city;
        $data['district'] = $district;
        $data['title'] = trans('properties/list.title') . ': ' . trans('countries.name.' . $country) . ', ' . trans('feeds/districts.city.' . $city . '.name') . ', ' . trans('feeds/districts.city.' . $city . '.' . $district);
        return view('properties.list', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $input = $request->except('_token');
        $data = $this->getList($input);
        $data['title'] = trans('properties/search.title', ['keywords' => $input['keywords'] ?? '']);
        $data = array_merge($input, $data);
        return view('properties.list', $data);
    }

    /**
     * Show the form for creating the specified property.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = [];
        return view('properties.create', $data);
    }

    /**
     * Store a newly created property in storage.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate(Property::ADDING_RULES, Property::RULE_TRANSLATION);

        //$property = $this->prepare($request, $this->property);
        //$property->save();

        return redirect()->route('properties.show', $property)->withSuccess('Property created');
    }

    /**
     * Display the specified property.
     *
     * @param $country
     * @param $city
     * @param $district
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($country, $city, $district, $id)
    {
        $property = Property::where('id', $id)
            ->where('country', $country)
            ->where('city', $city)
            ->where('district', $district)
            ->firstOrFail();
        $data = $property->toArray();
        $data['link'] = $property->link;
        $data['name'] = $this->property->getAddress($data);
        $data['title'] = Str::ucfirst($this->feedService->getText($data, 'description'));
        $data['topic'] = $this->feedService->getText($data, 'title');
        $data['text'] = $this->feedService->getText($data, 'content');
        $data['picture'] = $this->feedService->getPictureLink($data);
        $data['priceChartTitle'] = $this->feedService->translateContent(trans('properties/show.price_chart_title'), $data);
        $data['priceChartDescription'] = $this->feedService->translateContent(trans('properties/show.price_chart_description'), $data);
        $data['priceChartData'] = $this->statService->getPriceStatByRegion($property);
        $data['links'] = $this->viewService->getPreviousAndNexLinks($property);
        $data['details'] = Auth::check() && Auth::user()->email_verified_at;
        return view('properties.show', $data);
    }

    /**
     * Show the form for editing the specified property.
     *
     * @param Property $property
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Property $property)
    {
        $data = $property->prepare('edit');
        return view('properties.edit', $data);
    }

    /**
     * Update the specified property in storage.
     *
     * @param Request $request
     * @param Property $property
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Property $property)
    {
        $request->validate(Property::EDITING_RULES, Property::RULE_TRANSLATION);
        $property = $this->prepare($request, $property);
        $property->save();
        $route = redirect()->route('properties.show', $property);
        return empty($errors) ? $route->withSuccess('Property updated') : $route->withErrors($errors);
    }

    /**
     * Remove the specified property from storage.
     *
     * @param Property $property
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('properties.index')->withSuccess('Property deleted');
    }

    /**
     * Click the link
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function link(int $id)
    {
        $data = Property::where('id', $id)
            ->firstOrFail();
        return redirect($data->link ?? '');
    }

    /**
     * Get property list
     *
     * @param array $input
     * @return array
     */
    private function getList(array $input): array
    {
        $page = $input['page'] ?? 1;
        $country = $input['country'] ?? '';
        $city = $input['city'] ?? '';
        $district = $input['district'] ?? '';

        $keywords = $input['keywords'] ?? '';
        $rooms = $input['rooms'] ?? 0;
        $floors = $input['floors'] ?? 0;
        $space = $input['space'] ?? 0;
        $price = $input['price'] ?? 0;
        $payback = $input['payback'] ?? 0;

        if (empty($input['find'])) {
            $records = Cache::remember(
                'Properties:getList:' . $country . ':' . $city . ':' . $district,
                3600,
                function () use ($country, $city, $district) {
                    return Property::where(function ($query) use ($country, $city, $district) {
                        !$country ?: $query->where('country', $country);
                        !$city ?: $query->where('city', $city);
                        !$district ?: $query->where('district', $district);
                    })->orderBy('profit', 'DESC')
                        ->get();
                }
            );
        } else {
            $records = Property::where(function ($query) use ($keywords, $rooms, $floors, $space, $price, $payback) {
                empty($rooms) ?: $query->where('rooms', $rooms);

                switch($floors) {
                    case 1: $query->where('floors', '<=', 5); break;
                    case 2: $query->whereBetween('floors', [6, 9]); break;
                    case 3: $query->where('floors', '>', 9); break;
                }

                switch($space) {
                    case 1: $query->where('space', '<', 40); break;
                    case 2: $query->whereBetween('space', [40, 80]); break;
                    case 3: $query->where('space', '>', 80); break;
                }

                switch($price) {
                    case 1: $query->where('price', '<', 50000); break;
                    case 2: $query->whereBetween('price', [50000, 100000]); break;
                    case 3: $query->where('price', '>', 100000); break;
                }

                switch($payback) {
                    case 1: $query->where('payback', '<', 10); break;
                    case 2: $query->whereBetween('payback', [11, 15]); break;
                    case 3: $query->where('payback', '>', 15); break;
                }

                $keywords = Str::lower($keywords);
                $keywords = trim(preg_replace("/[[:space:]]+/su", " ", $keywords));
                $keyword = explode(' ', $keywords);
                $count = count($keyword);
                for ($i = 0; $i < $count; $i++) {
                    $query->where('search', 'LIKE', '%' . $keyword[$i] . '%');
                }
            })->orderBy('profit', 'DESC')
                ->get();
        }

        $path = strtok($_SERVER['REQUEST_URI'], '?');
        $data = new LengthAwarePaginator($records->forPage($page, self::NUMBER_PER_PAGE), $records->count(), self::NUMBER_PER_PAGE, $page, ['path' => $path]);
        return [
            'input'    => $input,
            'language' => app()->getLocale(),
            'records'  => $data
        ];
    }
}
