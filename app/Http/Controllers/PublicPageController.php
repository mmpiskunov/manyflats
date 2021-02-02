<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Services\Data\SettingService;
use App\Services\Data\ViewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PublicPageController extends Controller
{
    const BUY_STANDARD_URL = 'https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=internet-stolica&InvId=0&Culture=en&Encoding=utf-8&Description=manyflats&OutSum=16473&SignatureValue=';
    const BUY_PREMIUM_URL = 'https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=internet-stolica&InvId=0&Culture=en&Encoding=utf-8&Description=manyflats&OutSum=82698&SignatureValue=';

    public function index(ViewService $viewService)
    {
        $language = app()->getLocale();
        $pictures = $viewService->getCountryPictures();
        $countries = $viewService->getSortingCountryAndCityList();
        return view('main', compact('language', 'countries', 'pictures'));
    }

    /**
     * Display a about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        $data = Cache::remember(
            'About:Statistic:Table',
            300,
            function () {
                return [
                    'properties' => Property::count(),
                    'users'      => User::whereNotNull('email_verified_at')->count(),
                    'countries'  => count(SettingService::COUNTRIES),
                    'cities'     => count(SettingService::CITIES),
                ];
            });
        return view('public.about', $data);
    }

    /**
     * Display a price page.
     *
     * @return \Illuminate\Http\Response
     */
    public function price()
    {
        return view('public.price');
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function buy(int $id)
    {
        return redirect($id == 1 ? self::BUY_STANDARD_URL : self::BUY_PREMIUM_URL);
    }

    /**
     * Display a contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        $input = $request->except('_token');
        $data = [];
        return view('home', $data);
    }
}
