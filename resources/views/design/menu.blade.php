@php
    $routeData =  explode('.', Route::currentRouteName());
    $language = $routeData[0] ?? '';
    $routeGroup = !empty($routeData[2]) ? $routeData[1] : '';
    $routeAction = !empty($routeData[2]) ? $routeData[2] : $routeData[1];
    $route = $routeGroup . '.' . $routeAction;
    $uri = $_SERVER['REQUEST_URI'];
    $countryList = (new App\Services\Data\ViewService)->getSortingCountryAndCityList();
@endphp

<!--================ Navigation ================-->
<nav class="mad-navigation-container">
    <ul class="mad-navigation mad-navigation--vertical-sm">

        <li class="menu-item @if (in_array($routeGroup, ['public.index'])) current-menu-item @endif">
            <a href="{{ route('public.index') }}">{{ trans('layouts/menu.home') }}</a>
        </li>

        <li class="menu-item @if (strpos($uri, '/properties') !== false) current-menu-item @endif menu-item-has-children with-sub-inner">
            <a href="{{ route('properties.index') }}">{{ trans('layouts/menu.properties') }}</a>
            <!--================ Sub Menu ================-->
            <ul class="sub-menu">
                @foreach($countryList as $countryName => $citiesList)
                    <li class="menu-item menu-item-has-children @if (strpos($uri, '/' . $countryName) !== false) current-menu-item @endif">
                        <a href="{{ route('properties.country', ['country' => $countryName]) }}">
                            {{ trans('countries.name.' . $countryName) }}
                        </a>
                        <!--================ Sub Sub Menu ================-->
                        <ul class="sub-menu">
                            <li class="menu-item @if (strpos($uri, '/' . $countryName .'/list') !== false) current-menu-item @endif">
                                <a href="{{ route('properties.country', ['country' => $countryName]) }}">{{ trans('layouts/menu.all_cities') }}</a>
                            </li>
                            @if (count($citiesList) < 7)
                                @foreach($citiesList as $cityName)
                                    <li class="menu-item @if (strpos($uri, '/' . $countryName . '/' . $cityName . '/') !== false) current-menu-item @endif">
                                        <a href="{{ route('properties.city', ['country' => $countryName, 'city' => $cityName]) }}">
                                            {{ trans('feeds/districts.city.' . $cityName . '.name') }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                @php
                                    $itemAmount = count($citiesList);
                                    $stepAmount = ceil($itemAmount / ceil($itemAmount / 7));
                                    $currentItemNumber = 0;
                                    $firstNumber = $lastNumber = $firstLetter = $lastLetter = [];
                                    foreach ($citiesList as $i => $cityName) {
                                        bcmod($i + 1, $stepAmount) ?: $currentItemNumber++;
                                        $letter = preg_replace("/^(.).*/sDu", "\\1", trans('feeds/districts.city.' . $cityName . '.name'));
                                        if (empty($firstLetter[$currentItemNumber])) {
                                            $firstNumber[$currentItemNumber] = $i;
                                            $firstLetter[$currentItemNumber] = $letter;
                                        }
                                        $lastNumber[$currentItemNumber] = $i;
                                        $lastLetter[$currentItemNumber] = $letter;
                                    }
                                @endphp
                                @foreach ($firstNumber as $currentItemNumber => $value)
                                <li class="menu-item menu-item-has-children">
                                    <a href="{{ route('properties.city', ['country' => $countryName, 'city' => $citiesList[$firstNumber[$currentItemNumber]]]) }}">
                                        @if ($firstLetter[$currentItemNumber] == $lastLetter[$currentItemNumber])
                                            {{ trans('layouts/menu.city_letter', ['a' => $firstLetter[$currentItemNumber]]) }}
                                        @else
                                            {{ trans('layouts/menu.city_letters', ['a' => $firstLetter[$currentItemNumber], 'z' => $lastLetter[$currentItemNumber]]) }}
                                        @endif
                                    </a>
                                    <ul class="sub-menu">
                                        @foreach ($citiesList as $currentSubItemNumber => $cityName)
                                            @if($firstNumber[$currentItemNumber] <= $currentSubItemNumber && $currentSubItemNumber <= $lastNumber[$currentItemNumber])
                                                <li class="menu-item @if (strpos($uri, '/' . $countryName . '/' . $cityName . '/') !== false) current-menu-item @endif">
                                                    <a href="{{ route('properties.city', ['country' => $countryName, 'city' => $cityName]) }}">
                                                        {{ trans('feeds/districts.city.' . $cityName . '.name') }}
                                                    </a>
                                                </li>
                                            @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                    <!--================ End of Sub Sub Menu ================-->
                </li>
            @endforeach
        </ul>
        <!--================ End of Sub Menu ================-->
    </li>

    {{--
    @guest
    @else
    <li class="menu-item @if (strpos($uri, '/price') !== false) current-menu-item @endif">
        <a href="{{ route('public.price') }}">{{ trans('layouts/menu.price') }}</a>
    </li>
    @endif
    --}}

    <li class="menu-item" style="width:50px">&nbsp;</li>

    {{--
    <li class="menu-item menu-item-has-children mega-menu">
        <a href="{{ $uriForCurrency . 'EUR' }}" class="text-secondary">EUR</a>
        <!--================ Sub Menu ================-->
        <ul class="sub-menu">
            <li class="menu-item menu-item-has-children">
                <!--================ Sub Menu ================-->
                <ul class="sub-menu">
                    @for($i = 0; $i < $currencyCount; $i++)
                        @if ($i && $i%3 == 0)
                    </ul>
                    <!--================ End of Sub Menu ================-->
                </li>
                <li class="menu-item menu-item-has-children">
                    <!--================ Sub Menu ================-->
                    <ul class="sub-menu">
                        @endif
                        <li class="menu-item"><a href="{{ $uriForCurrency . $currencyList[$i] }}">{{ $currencyList[$i] }}</a></li>
                    @endfor
                </ul>
                <!--================ End of Sub Menu ================-->
            </li>
        </ul>
        <!--================ End of Sub Menu ================-->
    </li>
    --}}

        <li class="menu-item menu-item-has-children">
            @php $currentLanguage = app()->getLocale() @endphp
            <a href="{{ $uri }}" class="text-secondary">@if ($currentLanguage == 'en') English
                @elseif ($currentLanguage == 'ru') Русский
                @endif</a>
            <!--================ Sub Menu ================-->
            <ul class="sub-menu">
                @php $uri = preg_replace("/^\/[a-z]{2}\//sD", "/", $_SERVER['REQUEST_URI']) @endphp
                <li class="menu-item"><a href="{{ $uri }}">English</a></li>
                <li class="menu-item"><a href="{{ '/ru' . $uri }}">Русский</a></li>
            </ul>
            <!--================ End of Sub Menu ================-->
        </li>

    </ul>
</nav>
<!--================ End of Navigation ================-->
