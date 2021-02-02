@extends('design.list.app')
@section('title', $title)
@section('css')
    <style>
        div#mapdiv {
            height: 549px;
        }
    </style>
@endsection

@section('content')
    @include('layouts.search')

    <div class="mad-content top-size-2">
        <div class="mad-property-section">
            <div class="mad-tabs mad-tabs--style-2">
                <div class="mad-element">
                    <div class="mad-ag-wrap">
                        <div class="container">
                            <div class="mad-property-header">
                                <div class="mad-col">
                                    <nav class="mad-breadcrumb-path">
                                        <span>
                                            <a href="{{ route('public.index') }}">
                                                {{ trans('layouts/menu.home') }}
                                            </a>
                                        </span> /
                                        <span>
                                            <a href="{{ route('properties.country', ['country' => $country]) }}">
                                                {{ trans('countries.name.' . $country) }}
                                            </a>
                                        </span> /
                                        <span>
                                            <a href="{{ route('properties.city', ['country' => $country, 'city' => $city]) }}">
                                                {{ trans('feeds/districts.city.' . $city . '.name') }}
                                            </a>
                                        </span> /
                                        <span>
                                            <a href="{{ route('properties.city', ['country' => $country, 'city' => $city, 'district' => $district]) }}">
                                                {{ trans('feeds/districts.city.' . $city . '.' . $district) }}
                                            </a>
                                        </span> /
                                        <span>
                                            {{ $id }}
                                        </span>
                                    </nav>

                                    <h3 class="mad-title">{{ trans('properties/show.title') }}</h3>
                                    <p class="mad-text-small">{!! trans('properties/show.rent', ['rent' => (int)$rent . ' ' . trans('currencies.euro1'), 'profit' => $profit, 'payback' => $payback]) !!}</p>
                                </div>
                                <div class="mad-col col-xl-4 col-lg-3">{{-- col-xl-4 col-lg-3 // добавлено, чтобы не переносилась строка без кнопок --}}
                                    <div class="mad-page-nav">
                                        @if (!empty($links['previous']))
                                            <a href="{{ $links['previous'] ?? '' }}"><i class="material-icons">keyboard_arrow_left</i>{{ trans('properties/show.previous_property') }}</a>
                                        @endif
                                        @if (!empty($links['previous']) && !empty($links['next']))
                                            &nbsp;|&nbsp;
                                        @endif
                                        @if (!empty($links['next']))
                                            <a href="{{ $links['next'] ?? '' }}">{{ trans('properties/show.next_property') }}<i class="material-icons">keyboard_arrow_right</i></a>
                                        @endif
                                    </div>
                                    <div class="mad-property-info">
                                        <div class="mad-property-items">
                                            <div class="mad-item">
                                                <div class="mad-price">{{ (int)$price }} {{ trans('currencies.euro1') }}</div>
                                                {{-- // Расчётный платёж
                                                    <a href="#" class="mad-link link-blue"><i class="fa fa-calculator"></i>Estimate Payment</a>
                                                --}}
                                            </div>
                                            <div class="mad-item">
                                                <div class="mad-title">{{ (int)$rooms }}</div>
                                                {{ trans('properties/show.beds') }}
                                            </div>
                                            <div class="mad-item">
                                                <div class="mad-title">{{ (int)$floor }}/{{ (int)$floors }}</div>
                                                {{ trans('properties/show.short_floor') }}
                                            </div>
                                            <div class="mad-item">
                                                <div class="mad-title">{{ $space }} <span>{{ trans('common.m2') }}</span></div>
                                                {{ trans('currencies.euro1') }} {{ $price2m }} / {{ trans('common.m2') }}
                                            </div>
                                        </div>
                                        {{-- // Вызов и запись к агенту
                                        <div class="mad-col">
                                            <div class="btn-set">
                                                <a href="#" class="btn btn-style-4 btn-small"><i class="material-icons">calendar_today</i><span>Schedule Tour</span></a>
                                                <a href="#" class="btn btn-style-2 btn-small"><i class="material-icons">mail_outline</i><span>Contact The Agent</span></a>
                                                <a href="#" class="btn btn-style-3 btn-small"><i class="material-icons">favorite_border</i><span>Save</span></a>
                                                <a href="#" class="btn btn-style-3 btn-small"><i class="material-icons">share</i><span>Share</span></a>
                                            </div>
                                        </div>
                                        --}}
                                    </div>
                                </div>
                            </div>
                            {{-- // Навигационное меню по разделам
                            <!--================ Tabs Navigation ================-->
                            <div id="menu" class="mad-menu-tab" role="tablist">
                                <span class="tab-active">
                                    <a id="tab-1-link" href="#tab-1" role="tab" aria-selected="true" aria-controls="tab-1" class="mad-tab-link animated">
                                        {{ trans('properties/show.location') }}
                                    </a>
                                </span>
                                <span>
                                    <a id="tab-2-link" href="#tab-2" role="tab" aria-selected="false" aria-controls="tab-2" class="mad-tab-link animated">
                                        {{ trans('properties/show.property_history') }}
                                    </a>
                                </span>
                                <span>
                                    <a id="tab-3-link" href="#tab-3" role="tab" aria-selected="false" aria-controls="tab-3" class="mad-tab-link animated">
                                        {{ trans('properties/show.schools') }}
                                    </a>
                                </span>
                                <span>
                                    <a id="tab-4-link" href="#tab-4" role="tab" aria-selected="false" aria-controls="tab-4" class="mad-tab-link animated">
                                        {{ trans('properties/show.neighborhood') }}
                                    </a>
                                </span>
                                <span>
                                    <a id="tab-5-link" href="#tab-5" role="tab" aria-selected="false" aria-controls="tab-5" class="mad-tab-link animated">
                                        {{ trans('properties/show.safety_and_crime') }}
                                    </a>
                                </span>
                                <span>
                                    <a id="tab-6-link" href="#tab-6" role="tab" aria-selected="false" aria-controls="tab-6" class="mad-tab-link animated">
                                        {{ trans('properties/show.payment_calculator') }}
                                    </a>
                                </span>
                                <span>
                                    <a id="tab-7-link" href="#tab-7" role="tab" aria-selected="false" aria-controls="tab-7" class="mad-tab-link animated">
                                        {{ trans('properties/show.similar_homes') }}
                                    </a>
                                </span>
                            </div>
                            <!--================ End of Tabs Navigation ================-->
                            --}}
                        </div>
                    </div>
                </div>
                <div class="mad-property-content">
                    <div class="container">
                        <div class="row size-2">
                            <main id="main" class="col-xl-9 col-lg-8">
                                <div class="content-element-4">
                                    <div class="mad-tabbed-carousel">
                                        {{-- // Всплывающее окно
                                            <a href="#tab-41" class="mad-zoom" data-arctic-modal="#mad-property-modal"><img src="/images/zoom.png" alt=""></a>
                                        --}}
                                        {{-- <div class="owl-carousel with-nav type-2" id="sync1"> --}}
                                            <div class="mad-grid-item">
                                                <img src="{{ $picture }}" alt="{{ $title }}">
                                            </div>
                                            {{--
                                            <div class="mad-grid-item">
                                                <img src="images/1024x584_img2.jpg" alt="">
                                            </div>
                                            <div class="mad-grid-item">
                                                <img src="images/1024x584_img3.jpg" alt="">
                                            </div>
                                            <div class="mad-grid-item">
                                                <img src="images/1024x584_img4.jpg" alt="">
                                            </div>
                                            <div class="mad-grid-item">
                                                <img src="images/1024x584_img5.jpg" alt="">
                                            </div>
                                            <div class="mad-grid-item">
                                                <img src="images/1024x584_img6.jpg" alt="">
                                            </div>
                                            <div class="mad-grid-item">
                                                <img src="images/1024x584_img7.jpg" alt="">
                                            </div>
                                            <div class="mad-grid-item">
                                                <img src="images/1024x584_img8.jpg" alt="">
                                            </div>
                                            <div class="mad-grid-item">
                                                <img src="images/1024x584_img9.jpg" alt="">
                                            </div>
                                            --}}
                                        {{-- </div> --}}
                                        {{-- // Миниатюры под большим фото и видео
                                        <div class="mad-tabbed-bottom">
                                            <div class="mad-col">
                                                <!-- - - - - - - - - - - - - - Carousel - - - - - - - - - - - - - - - - -->
                                                <div class="owl-carousel with-nav-2 owl-theme" id="sync2">
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img1.jpg" alt="">
                                                    </div>
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img2.jpg" alt="">
                                                    </div>
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img3.jpg" alt="">
                                                    </div>
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img4.jpg" alt="">
                                                    </div>
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img5.jpg" alt="">
                                                    </div>
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img6.jpg" alt="">
                                                    </div>
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img7.jpg" alt="">
                                                    </div>
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img8.jpg" alt="">
                                                    </div>
                                                    <div class="mad-grid-item">
                                                        <img src="images/104x104_img9.jpg" alt="">
                                                    </div>
                                                </div>
                                                <!-- - - - - - - - - - - - - - End of Carousel - - - - - - - - - - - - - - - - -->
                                            </div>
                                            <div class="mad-col">
                                                <div class="mad-tabbed-items">
                                                    <a href="#tab-43" class="btn btn-style-3" data-arctic-modal="#mad-property-modal"><span><i class="material-icons">360</i> 360° <br> Virtual Tour</span></a>
                                                    <a href="#tab-44" class="btn btn-style-3" data-arctic-modal="#mad-property-modal"><span><i class="material-icons">streetview</i> Street <br> View</span></a>
                                                    <a href="#tab-45" class="btn btn-style-3" data-arctic-modal="#mad-property-modal"><span><i class="material-icons">map</i> Map <br> View</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        --}}
                                    </div>
                                </div>
                                <!--================ Tabs Container ================-->
                                <div class="content-element-6">
                                    <h4>{{ trans('properties/show.description') }}</h4>
                                    <p class="text-justify">{{ strip_tags($text) }}</p>
                                    {{-- // Разворачиваемое описание
                                    <p>Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum
                                        magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi
                                        et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel,
                                        scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.
                                        Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit
                                        sed leo. Ut pharetra augue nec augue.</p>
                                    <p class="toggle-section">Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum
                                        dictum
                                        magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor
                                        wisi
                                        et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Vestibulum libero nisl, porta vel,
                                        scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.
                                        Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit
                                        sed leo. Ut pharetra augue nec augue.</p>
                                    <a href="#" class="mad-read-more size-2 type-2 toggle-btn">View <span></span></a>
                                    --}}
                                </div>
                                {{-- // Ближайший показ объектов
                                <div class="content-element-6">
                                    <h4>{{ trans('properties/show.open_houses') }}</h4>
                                    <div class="mad-open-item">
                                        <div class="mad-col">
                                            <div class="mad-open">
                                                <i class="mad-icon-box-icon"><img class="svg" src="sweetsqft_svg_icons/sell_home.svg" alt=""></i>
                                                <div class="mad-open-cont">
                                                    <h5 class="mad-title">Saturday, Oct 26th</h5>
                                                    <span>3:00 PM - 4:30 PM</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mad-col">
                                            <a href="#" class="btn btn-style-3"><i class="material-icons">calendar_today</i><span>Add to Calendar</span></a>
                                        </div>
                                    </div>
                                </div>
                                --}}
                                {{-- // Удобства
                                <div class="content-element-6">
                                    <h4>{{ trans('properties/show.amenities') }}</h4>
                                    <div class="content-element">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mad-entity-content">
                                                    <ul class="mad-list--icon">
                                                        <li>Master Ensuite<i class="icon material-icons">check</i></li>
                                                        <li>Eat-in Kitchen<i class="icon material-icons">check</i></li>
                                                        <li>High Ceilings<i class="icon material-icons">check</i></li>
                                                        <li>Custom Closet<i class="icon material-icons">check</i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mad-entity-content">
                                                    <ul class="mad-list--icon">
                                                        <li>Private Parking<i class="icon material-icons">check</i></li>
                                                        <li>Private Yard<i class="icon material-icons">check</i></li>
                                                        <li>Dishwasher<i class="icon material-icons">check</i></li>
                                                        <li>Hardwood Floors<i class="icon material-icons">check</i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content-element toggle-section">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mad-entity-content">
                                                    <ul class="mad-list--icon">
                                                        <li>Master Ensuite<i class="icon material-icons">check</i></li>
                                                        <li>Eat-in Kitchen<i class="icon material-icons">check</i></li>
                                                        <li>High Ceilings<i class="icon material-icons">check</i></li>
                                                        <li>Custom Closet<i class="icon material-icons">check</i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mad-entity-content">
                                                    <ul class="mad-list--icon">
                                                        <li>Private Parking<i class="icon material-icons">check</i></li>
                                                        <li>Private Yard<i class="icon material-icons">check</i></li>
                                                        <li>Dishwasher<i class="icon material-icons">check</i></li>
                                                        <li>Hardwood Floors<i class="icon material-icons">check</i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="mad-read-more size-2 type-2 toggle-btn">View <span></span></a>
                                </div>
                                --}}
                                <div class="mad-container">
                                    @if(!empty($latitude) && !empty($longitude))
                                        <!--================ Tab ================-->
                                        <div id="tab-1" class="content-element-6">
                                            <h4>{{ trans('properties/show.location') }}</h4>
                                            {{-- <div id="googleMap2" class="mad-gmap size-3"></div> --}}
                                            <div id="mapdiv" class="mad-gmap size-3"></div>
                                        </div>
                                        <!--================ End of Tab ================-->
                                    @endif
                                    {{--
                                    <!--================ Tab ================-->
                                    <div id="tab-2" class="content-element-6">
                                        <h4>{{ trans('properties/show.property_history2') }}</h4>
                                        <!--================ Horizontal Table ================-->
                                        <div class="mad-table-wrap content-element-1">
                                            <table class="mad-table--responsive-md">
                                                <thead>
                                                <tr class="bg">
                                                    <th>Date</th>
                                                    <th>Event & Source</th>
                                                    <th>Price</th>
                                                    <th>Appreciation</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td data-cell-title="Date">May 30, 2019</td>
                                                    <td data-cell-title="Event & Source">
                                                        <p class="mad-text-other">Listed (Active) <br>
                                                            <span>RLS #OLRS-0076353</span></p>
                                                    </td>
                                                    <td data-cell-title="Price">$2,999,000</td>
                                                    <td data-cell-title="Appreciation">---</td>
                                                </tr>
                                                <tr>
                                                    <td data-cell-title="Date">Jan 25, 2019</td>
                                                    <td data-cell-title="Event & Source">
                                                        <p class="mad-text-other">Permanently Off Market <br>
                                                            <span>RLS #OLRS-0076353</span></p>
                                                    </td>
                                                    <td data-cell-title="Price">---</td>
                                                    <td data-cell-title="Appreciation">---</td>
                                                </tr>
                                                <tr>
                                                    <td data-cell-title="Date">Nov 17, 2018</td>
                                                    <td data-cell-title="Event & Source">
                                                        <p class="mad-text-other">Price Change <br>
                                                            <span>RLS #OLRS-0076353</span></p>
                                                    </td>
                                                    <td data-cell-title="Price">$2,299,000</td>
                                                    <td data-cell-title="Appreciation">---</td>
                                                </tr>
                                                <tr class="toggle-section">
                                                    <td data-cell-title="Date">Jan 25, 2019</td>
                                                    <td data-cell-title="Event & Source">
                                                        <p class="mad-text-other">Permanently Off Market <br>
                                                            <span>RLS #OLRS-0076353</span></p>
                                                    </td>
                                                    <td data-cell-title="Price">---</td>
                                                    <td data-cell-title="Appreciation">---</td>
                                                </tr>
                                                <tr class="toggle-section">
                                                    <td data-cell-title="Date">Nov 17, 2018</td>
                                                    <td data-cell-title="Event & Source">
                                                        <p class="mad-text-other">Price Change <br>
                                                            <span>RLS #OLRS-0076353</span></p>
                                                    </td>
                                                    <td data-cell-title="Price">$2,299,000</td>
                                                    <td data-cell-title="Appreciation">---</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--================ End of Horizontal Table ================-->
                                        <a href="#" class="mad-read-more size-2 type-2 toggle-btn">View <span></span></a>
                                    </div>
                                    <!--================ End of Tab ================-->
                                    --}}
                                    {{--
                                    <!--================ Tab ================-->
                                    <div id="tab-3" class="content-element-6">
                                        <h4>{{ trans('properties/show.schools2') }}</h4>
                                        <div class="tabs tabs-section mad-iso-tabs">
                                            <!--tabs navigation-->
                                            <ul class="tabs-nav">
                                                <li class=""><a href="#tab-21">All</a></li>
                                                <li class=""><a href="#tab-22">Elementary</a></li>
                                                <li class=""><a href="#tab-23">Middle</a></li>
                                                <li class=""><a href="#tab-24">High</a></li>
                                            </ul>
                                            <!--tabs content-->
                                            <div class="mad-tabs-content">
                                                <!--================ Tab ================-->
                                                <div id="tab-21">
                                                    <!--================ Horizontal Table ================-->
                                                    <div class="mad-table-wrap content-element-1">
                                                        <table class="mad-table--responsive-md">
                                                            <thead>
                                                            <tr class="bg">
                                                                <th>Date</th>
                                                                <th>Event & Source</th>
                                                                <th>Price</th>
                                                                <th>Appreciation</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td data-cell-title="Date">May 30, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Listed (Active) <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,999,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-cell-title="Date">Jan 25, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Permanently Off Market <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">---</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-cell-title="Date">Nov 17, 2018</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Price Change <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,299,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr class="toggle-section">
                                                                <td data-cell-title="Date">Jan 25, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Permanently Off Market <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">---</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr class="toggle-section">
                                                                <td data-cell-title="Date">Nov 17, 2018</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Price Change <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,299,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--================ End of Horizontal Table ================-->
                                                    <a href="#" class="mad-read-more size-2 type-2 toggle-btn">View <span></span></a>
                                                </div>
                                                <!--================ End of Tab ================-->
                                                <!--================ Tab ================-->
                                                <div id="tab-22">
                                                    <!--================ Horizontal Table ================-->
                                                    <div class="mad-table-wrap content-element-1">
                                                        <table class="mad-table--responsive-md">
                                                            <thead>
                                                            <tr class="bg">
                                                                <th>Date</th>
                                                                <th>Event & Source</th>
                                                                <th>Price</th>
                                                                <th>Appreciation</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td data-cell-title="Date">May 30, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Listed (Active) <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,999,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-cell-title="Date">Jan 25, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Permanently Off Market <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">---</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-cell-title="Date">Nov 17, 2018</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Price Change <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,299,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr class="toggle-section">
                                                                <td data-cell-title="Date">Jan 25, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Permanently Off Market <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">---</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr class="toggle-section">
                                                                <td data-cell-title="Date">Nov 17, 2018</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Price Change <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,299,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--================ End of Horizontal Table ================-->
                                                    <a href="#" class="mad-read-more size-2 type-2 toggle-btn">View <span></span></a>
                                                </div>
                                                <!--================ End of Tab ================-->
                                                <!--================ Tab ================-->
                                                <div id="tab-23">
                                                    <!--================ Horizontal Table ================-->
                                                    <div class="mad-table-wrap content-element-1">
                                                        <table class="mad-table--responsive-md">
                                                            <thead>
                                                            <tr class="bg">
                                                                <th>Date</th>
                                                                <th>Event & Source</th>
                                                                <th>Price</th>
                                                                <th>Appreciation</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td data-cell-title="Date">May 30, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Listed (Active) <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,999,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-cell-title="Date">Jan 25, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Permanently Off Market <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">---</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-cell-title="Date">Nov 17, 2018</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Price Change <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,299,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr class="toggle-section">
                                                                <td data-cell-title="Date">Jan 25, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Permanently Off Market <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">---</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr class="toggle-section">
                                                                <td data-cell-title="Date">Nov 17, 2018</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Price Change <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,299,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--================ End of Horizontal Table ================-->
                                                    <a href="#" class="mad-read-more size-2 type-2 toggle-btn">View <span></span></a>
                                                </div>
                                                <!--================ End of Tab ================-->
                                                <!--================ Tab ================-->
                                                <div id="tab-24">
                                                    <!--================ Horizontal Table ================-->
                                                    <div class="mad-table-wrap content-element-1">
                                                        <table class="mad-table--responsive-md">
                                                            <thead>
                                                            <tr class="bg">
                                                                <th>Date</th>
                                                                <th>Event & Source</th>
                                                                <th>Price</th>
                                                                <th>Appreciation</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td data-cell-title="Date">May 30, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Listed (Active) <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,999,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-cell-title="Date">Jan 25, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Permanently Off Market <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">---</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-cell-title="Date">Nov 17, 2018</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Price Change <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,299,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr class="toggle-section">
                                                                <td data-cell-title="Date">Jan 25, 2019</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Permanently Off Market <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">---</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            <tr class="toggle-section">
                                                                <td data-cell-title="Date">Nov 17, 2018</td>
                                                                <td data-cell-title="Event & Source">
                                                                    <p class="mad-text-other">Price Change <br>
                                                                        <span>RLS #OLRS-0076353</span></p>
                                                                </td>
                                                                <td data-cell-title="Price">$2,299,000</td>
                                                                <td data-cell-title="Appreciation">---</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--================ End of Horizontal Table ================-->
                                                    <a href="#" class="mad-read-more size-2 type-2 toggle-btn">View <span></span></a>
                                                </div>
                                                <!--================ End of Tab ================-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--================ End of Tab ================-->
                                    --}}
                                    {{--
                                    <!--================ Tab ================-->
                                    <div id="tab-4" class="content-element-6">
                                        <h4>{{ trans('properties/show.neighborhood2') }}</h4>
                                        <div class="content-element">
                                            <div class="tabs tabs-section mad-iso-tabs">
                                                <!--tabs navigation-->
                                                <ul class="tabs-nav">
                                                    <li class=""><a href="#tab-31">Highlights</a></li>
                                                    <li class=""><a href="#tab-32">Restaurants</a></li>
                                                    <li class=""><a href="#tab-33">Groceries</a></li>
                                                    <li class=""><a href="#tab-34">Nightlife</a></li>
                                                    <li class=""><a href="#tab-35">Cafes</a></li>
                                                    <li class=""><a href="#tab-36">Shopping</a></li>
                                                    <li class=""><a href="#tab-37">Arts and Entertainment</a></li>
                                                    <li class=""><a href="#tab-38">Fitness</a></li>
                                                </ul>
                                                <!--tabs content-->
                                                <div class="mad-tabs-content">
                                                    <!--================ Tab ================-->
                                                    <div id="tab-31">
                                                        <div class="content-element">
                                                            <!--================ Google Map ================-->
                                                            <div id="googleMap3" class="mad-gmap size-3"></div>
                                                        </div>
                                                        <div class="content-element">
                                                            <div class="owl-carousel mad-entities mad-entity-hr mad-small-gap mad-grid mad-grid--cols-4 with-nav-2">
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--================ End of Tab ================-->
                                                    <!--================ Tab ================-->
                                                    <div id="tab-32">
                                                        <div class="content-element">
                                                            <!--================ Google Map ================-->
                                                            <div id="googleMap4" class="mad-gmap size-3"></div>
                                                        </div>
                                                        <div class="content-element">
                                                            <div class="owl-carousel mad-entities mad-entity-hr mad-small-gap mad-grid mad-grid--cols-4 with-nav-2">
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--================ End of Tab ================-->
                                                    <!--================ Tab ================-->
                                                    <div id="tab-33">
                                                        <div class="content-element">
                                                            <!--================ Google Map ================-->
                                                            <div id="googleMap5" class="mad-gmap size-3"></div>
                                                        </div>
                                                        <div class="content-element">
                                                            <div class="owl-carousel mad-entities mad-entity-hr mad-small-gap mad-grid mad-grid--cols-4 with-nav-2">
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--================ End of Tab ================-->
                                                    <!--================ Tab ================-->
                                                    <div id="tab-34">
                                                        <div class="content-element">
                                                            <!--================ Google Map ================-->
                                                            <div id="googleMap6" class="mad-gmap size-3"></div>
                                                        </div>
                                                        <div class="content-element">
                                                            <div class="owl-carousel mad-entities mad-entity-hr mad-small-gap mad-grid mad-grid--cols-4 with-nav-2">
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--================ End of Tab ================-->
                                                    <!--================ Tab ================-->
                                                    <div id="tab-35">
                                                        <div class="content-element">
                                                            <!--================ Google Map ================-->
                                                            <div id="googleMap7" class="mad-gmap size-3"></div>
                                                        </div>
                                                        <div class="content-element">
                                                            <div class="owl-carousel mad-entities mad-entity-hr mad-small-gap mad-grid mad-grid--cols-4 with-nav-2">
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--================ End of Tab ================-->
                                                    <!--================ Tab ================-->
                                                    <div id="tab-36">
                                                        <div class="content-element">
                                                            <!--================ Google Map ================-->
                                                            <div id="googleMap8" class="mad-gmap size-3"></div>
                                                        </div>
                                                        <div class="content-element">
                                                            <div class="owl-carousel mad-entities mad-entity-hr mad-small-gap mad-grid mad-grid--cols-4 with-nav-2">
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--================ End of Tab ================-->
                                                    <!--================ Tab ================-->
                                                    <div id="tab-37">
                                                        <div class="content-element">
                                                            <!--================ Google Map ================-->
                                                            <div id="googleMap9" class="mad-gmap size-3"></div>
                                                        </div>
                                                        <div class="content-element">
                                                            <div class="owl-carousel mad-entities mad-entity-hr mad-small-gap mad-grid mad-grid--cols-4 with-nav-2">
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--================ End of Tab ================-->
                                                    <!--================ Tab ================-->
                                                    <div id="tab-38">
                                                        <div class="content-element">
                                                            <!--================ Google Map ================-->
                                                            <div id="googleMap10" class="mad-gmap size-3"></div>
                                                        </div>
                                                        <div class="content-element">
                                                            <div class="owl-carousel mad-entities mad-entity-hr mad-small-gap mad-grid mad-grid--cols-4 with-nav-2">
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img1.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Restaurants</a>
                                                                                <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img2.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Nightlife</a>
                                                                                <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img3.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Cafes</a>
                                                                                <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                                <div class="mad-grid-item">
                                                                    <!--================ Entity ================-->
                                                                    <article class="mad-entity">
                                                                        <div class="mad-entity-media">
                                                                            <a href="#"><img src="images/96x96_img4.jpg" alt=""></a>
                                                                        </div>
                                                                        <div class="mad-entity-content">
                                                                            <div class="mad-entity-header">
                                                                                <a href="#" class="mad-entity-type">Shopping</a>
                                                                                <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </article>
                                                                    <!--================ End of Entity ================-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--================ End of Tab ================-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mad-text-micro">Amenity information provided by <span><img src="images/yelp.png" alt=""></span></div>
                                    </div>
                                    <!--================ End of Tab ================-->
                                    --}}
                                    {{-- // Безопасность и криминал
                                    <!--================ Tab ================-->
                                    <div id="tab-5" class="content-element-6">
                                        <h4>{{ trans('properties/show.safety_and_crime2') }}</h4>
                                        <div class="content-element">
                                            <figure><img src="images/1024x416_img1.jpg" alt=""></figure>
                                        </div>
                                        <div class="mad-text-micro">Data provided by <a href="#" class="mad-link link-blue">SpotCrime.com</a> and <a href="#" class="mad-link link-blue">CrimeReports.com</a>. Learn more.</div>
                                    </div>
                                    <!--================ End of Tab ================-->
                                    --}}
                                    {{--
                                    <!--================ Tab ================-->
                                    <div id="tab-6" class="content-element-6">
                                        <h4>{{ trans('properties/show.payment_calculator2') }}</h4>
                                        <p>Calculate your monthly mortgage payments. All fields are required.</p>
                                        <div class="content-element-2">
                                            <form class="mad-contact-form">
                                                <div class="row size-1 row-size-1">
                                                    <div class="col-xl-3 col-sm-6">
                                                        <label>Home Price</label>
                                                        <div class="mad-scale">
                                                            <input type="text" value="$2,999,000" name="check_availability_price" readonly class="mad-range-slider-input">
                                                            <div class="mad-range-slider range-scale range-2"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-sm-6">
                                                        <label>Down Payment</label>
                                                        <div class="mad-scale with-add">
                                                            <input type="text" value="$359,880" name="check_availability_price" readonly class="mad-range-slider-input">
                                                            <input class="mad-add" type="text" placeholder="12%">
                                                            <div class="mad-range-slider range-scale range-3"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-sm-6">
                                                        <label>Interest Rate</label>
                                                        <div class="mad-scale">
                                                            <input type="text" value="3.79%" name="check_availability_price" readonly class="mad-range-slider-input">
                                                            <div class="mad-range-slider range-scale range-4"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-sm-6">
                                                        <label>Loan Type</label>
                                                        <div class="mad-custom-select size-2">
                                                            <select data-default-text="30-year fixed">
                                                                <option>Option 1</option>
                                                                <option>Option 2</option>
                                                                <option>Option 3</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="mad-rating-main mad-calc">
                                            <div class="mad-rating-title">
                                                <div class="mad-col">
                                                    <div class="mad-price-title">$15,429/month</div>
                                                    <span>30 year fixed, 3.79% Interest</span>
                                                    <div class="mad-pie">
                                                        <div class="color-1"></div>
                                                        <div class="color-2"></div>
                                                        <div class="color-3"></div>
                                                        <div class="color-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mad-rating-section">
                                                <div class="content-element-1">
                                                    <div class="row size-2">
                                                        <div class="col-md-6">
                                                            <ul class="mad-rating-list">
                                                                <li class="color-1">
                                                                    <span>Principal and Interest</span>
                                                                    <span>$12,282</span>
                                                                </li>
                                                                <li class="color-2">
                                                                    <span>Property Taxes</span>
                                                                    <span>$1,774</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="mad-rating-list">
                                                                <li class="color-3">
                                                                    <span>Homeowners' Insurance</span>
                                                                    <span>$75</span>
                                                                </li>
                                                                <li class="color-4">
                                                                    <span>Mortgage Insurance</span>
                                                                    <span>$1,298</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn btn-style-2 btn-small">Get Pre-qualified</a>
                                                <span class="mad-btn-text">or <a href="#" class="mad-link link-blue">See today's mortgage rates</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--================ End of Tab ================-->
                                    --}}
                                    {{--
                                    <!--================ Tab ================-->
                                    <div id="tab-7" class="content-element-6">
                                        <h4>{{ trans('properties/show.similar_homes2') }}</h4>
                                        <div class="mad-entities mad-grid mad-grid--cols-3 owl-carousel hidden carousel-style-2 with-nav">
                                            <!-- owl item -->
                                            <div class="mad-grid-item">
                                                <!--================ Entity ================-->
                                                <article class="mad-entity">
                                                    <div class="mad-entity-media">
                                                        <div class="mad-grid mad-grid--cols-1 owl-carousel with-nav-2">
                                                            <a href="#"><img src="images/328x208_img4.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img4.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img4.jpg" alt=""></a>
                                                        </div>
                                                        <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                                    </div>
                                                    <div class="mad-entity-content">
                                                        <header class="mad-entity-header">
                                                            <a href="#" class="mad-entity-type">House For Sale</a>
                                                            <a href="#" class="mad-entity-price">$519,900</a>
                                                        </header>
                                                        <div class="mad-entity-body">
                                                            <p class="mad-adress">338 Spear St Unit 21F, <br> San Francisco, CA 94105</p>
                                                        </div>
                                                        <footer class="mad-entity-footer">
                                                            <div class="mad-entity-stat">
                                                                <span><i class="licon-bed"></i>4bd</span>
                                                                <span><i class="licon-bathtub"></i>2ba</span>
                                                                <span><i class="licon-rulers"></i>2500 sqft</span>
                                                            </div>
                                                        </footer>
                                                    </div>
                                                </article>
                                                <!--================ End of Entity ================-->
                                            </div>
                                            <!-- / owl item -->
                                            <!-- owl item -->
                                            <div class="mad-grid-item">
                                                <!--================ Entity ================-->
                                                <article class="mad-entity">
                                                    <div class="mad-entity-media">
                                                        <div class="mad-grid mad-grid--cols-1 owl-carousel with-nav-2">
                                                            <a href="#"><img src="images/328x208_img5.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img5.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img5.jpg" alt=""></a>
                                                        </div>
                                                        <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                                    </div>
                                                    <div class="mad-entity-content">
                                                        <header class="mad-entity-header">
                                                            <a href="#" class="mad-entity-type">Condo/Townhome For Sale</a>
                                                            <a href="#" class="mad-entity-price">$229,900</a>
                                                        </header>
                                                        <div class="mad-entity-body">
                                                            <p class="mad-adress">338 Spear St Unit 21F, <br> San Francisco, CA 94105</p>
                                                        </div>
                                                        <footer class="mad-entity-footer">
                                                            <div class="mad-entity-stat">
                                                                <span><i class="licon-bed"></i>1bd</span>
                                                                <span><i class="licon-bathtub"></i>1ba</span>
                                                                <span><i class="licon-rulers"></i>600 sqft</span>
                                                            </div>
                                                        </footer>
                                                    </div>
                                                </article>
                                                <!--================ End of Entity ================-->
                                            </div>
                                            <!-- / owl item -->
                                            <!-- owl item -->
                                            <div class="mad-grid-item">
                                                <!--================ Entity ================-->
                                                <article class="mad-entity">
                                                    <div class="mad-entity-media">
                                                        <div class="mad-grid mad-grid--cols-1 owl-carousel with-nav-2">
                                                            <a href="#"><img src="images/328x208_img6.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img6.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img6.jpg" alt=""></a>
                                                        </div>
                                                        <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                                    </div>
                                                    <div class="mad-entity-content">
                                                        <header class="mad-entity-header">
                                                            <a href="#" class="mad-entity-type">House For Rent</a>
                                                            <a href="#" class="mad-entity-price">$9,900/mo</a>
                                                        </header>
                                                        <div class="mad-entity-body">
                                                            <p class="mad-adress">338 Spear St Unit 21F, <br> San Francisco, CA 94105</p>
                                                        </div>
                                                        <footer class="mad-entity-footer">
                                                            <div class="mad-entity-stat">
                                                                <span><i class="licon-bed"></i>2bd</span>
                                                                <span><i class="licon-bathtub"></i>2ba</span>
                                                                <span><i class="licon-rulers"></i>1600 sqft</span>
                                                            </div>
                                                        </footer>
                                                    </div>
                                                </article>
                                                <!--================ End of Entity ================-->
                                            </div>
                                            <!-- / owl item -->
                                            <!-- owl item -->
                                            <div class="mad-grid-item">
                                                <!--================ Entity ================-->
                                                <article class="mad-entity">
                                                    <div class="mad-entity-media">
                                                        <div class="mad-grid mad-grid--cols-1 owl-carousel with-nav-2">
                                                            <a href="#"><img src="images/328x208_img7.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img7.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img7.jpg" alt=""></a>
                                                        </div>
                                                        <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                                    </div>
                                                    <div class="mad-entity-content">
                                                        <header class="mad-entity-header">
                                                            <a href="#" class="mad-entity-type">Apartment For Sale</a>
                                                            <a href="#" class="mad-entity-price">$359,000</a>
                                                        </header>
                                                        <div class="mad-entity-body">
                                                            <p class="mad-adress">338 Spear St Unit 21F, <br> San Francisco, CA 94105</p>
                                                        </div>
                                                        <footer class="mad-entity-footer">
                                                            <div class="mad-entity-stat">
                                                                <span><i class="licon-bed"></i>3bd</span>
                                                                <span><i class="licon-bathtub"></i>2ba</span>
                                                                <span><i class="licon-rulers"></i>1900 sqft</span>
                                                            </div>
                                                        </footer>
                                                    </div>
                                                </article>
                                                <!--================ End of Entity ================-->
                                            </div>
                                            <!-- / owl item -->
                                            <!-- owl item -->
                                            <div class="mad-grid-item">
                                                <!--================ Entity ================-->
                                                <article class="mad-entity">
                                                    <div class="mad-entity-media">
                                                        <div class="mad-grid mad-grid--cols-1 owl-carousel with-nav-2">
                                                            <a href="#"><img src="images/328x208_img8.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img8.jpg" alt=""></a>
                                                            <a href="#"><img src="images/328x208_img8.jpg" alt=""></a>
                                                        </div>
                                                        <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                                    </div>
                                                    <div class="mad-entity-content">
                                                        <header class="mad-entity-header">
                                                            <a href="#" class="mad-entity-type">Apartment For Rent</a>
                                                            <a href="#" class="mad-entity-price">$5,500/mo</a>
                                                        </header>
                                                        <div class="mad-entity-body">
                                                            <p class="mad-adress">338 Spear St Unit 21F, <br> San Francisco, CA 94105</p>
                                                        </div>
                                                        <footer class="mad-entity-footer">
                                                            <div class="mad-entity-stat">
                                                                <span><i class="licon-bed"></i>3bd</span>
                                                                <span><i class="licon-bathtub"></i>2ba</span>
                                                                <span><i class="licon-rulers"></i>1700 sqft</span>
                                                            </div>
                                                        </footer>
                                                    </div>
                                                </article>
                                                <!--================ End of Entity ================-->
                                            </div>
                                            <!-- / owl item -->
                                        </div>
                                    </div>
                                    <!--================ End of Tab ================-->
                                    --}}
                                </div>
                                <!--================ End of Tabs Container ================-->
                            </main>
                            <aside id="sidebar" class="col-xl-3 col-lg-4">
                                <div class="mad-widget">
                                    <h5 class="mad-widget-title">
                                        {{ trans('properties/show.details') }}
                                    </h5>
                                    <div class="mad-property-list">
                                        <ul>
                                            <li>
                                                <span>{{ trans('properties/show.price') }}</span>
                                                <span>{{ (int)$price }} {{ trans('currencies.euro1') }}</span>
                                            </li>
                                            <li>
                                                <span>{{ trans('properties/show.price2m') }}</span>
                                                <span>{{ $price2m . ' ' . trans('currencies.euro1') . ' / ' . trans('common.m2') }}</span>
                                            </li>
                                            <li>
                                                <span>{{ trans('properties/show.space') }}</span>
                                                <span>{{ $space . ' ' . trans('common.m2') }}</span>
                                            </li>
                                            <li>
                                                <span>{{ trans('properties/show.rooms') }}</span>
                                                <span>{{ (int)$rooms }}</span>
                                            </li>
                                            <li>
                                                <span>{{ trans('properties/show.floor') }}</span>
                                                <span>{{ (int)$floor }}</span>
                                            </li>
                                            <li>
                                                <span>{{ trans('properties/show.floors') }}</span>
                                                <span>{{ (int)$floors }}</span>
                                            </li>
                                            <li>
                                                <span>{{ trans('properties/show.district') }}</span>
                                                <span>{{ trans('feeds/districts.city.' . $city . '.' . $district) }}</span>
                                            </li>
                                            <li>
                                                <span>{{ trans('properties/show.city') }}</span>
                                                <span>{{ trans('feeds/districts.city.' . $city . '.name') }}</span>
                                            </li>
                                            <li>
                                                <span>{{ trans('properties/show.country') }}</span>
                                                <span>{{ trans('countries.name.' . $country) }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mad-widget">
                                    <div class="btn-set">
                                        <a href="{{ route('properties.link', $id ?? 0) }}"
                                           class="btn btn-style-2 btn-small" target="_blank">
                                            <i class="licon-link"></i>
                                            <span>{{ trans('properties/show.follow') }}</span>
                                        </a>
                                    </div>
                                </div>
                                {{-- // Дата записи на осмотр квартиры
                                <div class="mad-widget">
                                    <h5 class="mad-widget-title">Go Tour This Home</h5>
                                    <div class="content-element">
                                        <div class="mad-calendar owl-carousel mad-grid mad-grid--cols-3 with-nav-2">
                                            <div class="mad-grid-item">
                                                <div class="mad-calendar-item">
                                                    Mon<div class="mad-calendar-date">21</div>Mar
                                                </div>
                                            </div>
                                            <div class="mad-grid-item">
                                                <div class="mad-calendar-item">
                                                    Tue<div class="mad-calendar-date">22</div>Mar
                                                </div>
                                            </div>
                                            <div class="mad-grid-item">
                                                <div class="mad-calendar-item">
                                                    Wed<div class="mad-calendar-date">23</div>Mar
                                                </div>
                                            </div>
                                            <div class="mad-grid-item">
                                                <div class="mad-calendar-item">
                                                    Thu<div class="mad-calendar-date">24</div>Mar
                                                </div>
                                            </div>
                                            <div class="mad-grid-item">
                                                <div class="mad-calendar-item">
                                                    Fri<div class="mad-calendar-date">25</div>Mar
                                                </div>
                                            </div>
                                            <div class="mad-grid-item">
                                                <div class="mad-calendar-item">
                                                    Sat<div class="mad-calendar-date">26</div>Mar
                                                </div>
                                            </div>
                                            <div class="mad-grid-item">
                                                <div class="mad-calendar-item">
                                                    Sun<div class="mad-calendar-date">27</div>Mar
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-style-4 w-100"><i class="material-icons">calendar_today</i><span>Shedule Tour for Free</span></a>
                                    <div class="mad-cancel align-center">With no obligation, cancel anytime</div>
                                </div>
                                --}}
                                {{-- // Агент по недвижимости
                                <div class="mad-widget">
                                    <h5 class="mad-widget-title">Listing Agent</h5>
                                    <div class="mad-team style-4">
                                        <div class="mad-col">
                                            <!--================ Team Member ================-->
                                            <figure class="mad-team-member">
                                                <a href="javascript:void(0)" class="mad-team-member-photo"><img src="/images/120x120_photo1.jpg" alt=""></a>
                                                <figcaption class="mad-team-member-info">
                                                    <div class="mad-info-wrap">
                                                        <h6 class="mad-team-member-name"><a href="#">Caroline Beek</a></h6>
                                                        <div class="mad-member-stat">Alliance Bay Realty</div>
                                                        <nav class="mad-info-block vr-list mad-links">
                                                            <ul>
                                                                <li><i class="mad-info-icon material-icons">phone</i>+1 208. 987.654</li>
                                                                <li><i class="mad-info-icon material-icons">phone_iphone</i>+1 208.654.321</li>
                                                            </ul>
                                                        </nav>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                            <!--================ End Of Team Member ================-->
                                        </div>
                                    </div>
                                </div>
                                --}}
                                {{-- // Форма отправки сообщения агенту
                                <div class="mad-widget">
                                    <h5 class="mad-widget-title">Contact The Agent</h5>
                                    <form class="mad-contact-form">
                                        <input type="text" placeholder="Name">
                                        <input type="email" placeholder="Email">
                                        <input type="tel" placeholder="Phone">
                                        <textarea rows="6" placeholder="I am interested in 435 E Hudson St, Long Beach, NY 11561"></textarea>
                                        <button type="submit" class="btn btn-style-2"><i class="material-icons">mail_outline</i><span>Send Message</span></button>
                                    </form>
                                </div>
                                --}}
                                {{-- // Рекомендуемые объекты
                                <div class="mad-widget">
                                    <h5 class="mad-widget-title">Featured Properties</h5>
                                    <div class="mad-entities mad-entities-type-2 with-owl-dots">
                                        <!--================ Entity ================-->
                                        <article class="mad-entity">
                                            <div class="mad-entity-media">
                                                <div class="mad-grid mad-grid--cols-1 owl-carousel with-dots">
                                                    <a href="#"><img src="/images/448x368_img1.jpg" alt=""></a>
                                                    <a href="#"><img src="/images/448x368_img1.jpg" alt=""></a>
                                                    <a href="#"><img src="/images/448x368_img1.jpg" alt=""></a>
                                                </div>
                                                <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                            </div>
                                            <div class="mad-entity-content">
                                                <header class="mad-entity-header">
                                                    <a href="#" class="mad-entity-price">$799,000</a>
                                                    <a href="#" class="mad-entity-type">House For Sale</a>
                                                </header>
                                                <footer class="mad-entity-footer">
                                                    <p class="mad-adress">338 Spear St Unit 21F, <br> San Francisco, CA 94105</p>
                                                    <div class="mad-entity-stat">
                                                        <span><i class="licon-bed"></i>5<br><span>bd</span></span>
                                                        <span><i class="licon-bathtub"></i>4<br><span>ba</span></span>
                                                        <span><i class="licon-rulers"></i>3650<br><span> sqft</span></span>
                                                    </div>
                                                </footer>
                                            </div>
                                        </article>
                                        <!--================ End of Entity ================-->
                                    </div>
                                </div>
                                --}}
                                {{-- // Недавно просмотренные
                                <div class="mad-widget">
                                    <h5 class="mad-widget-title">Recently Viewed</h5>
                                    <div class="mad-entities mad-entity-hr">
                                        <!--================ Entity ================-->
                                        <article class="mad-entity">
                                            <div class="mad-entity-media">
                                                <a href="#"><img src="/images/120x104_img1.jpg" alt=""></a>
                                                <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                            </div>
                                            <div class="mad-entity-content">
                                                <header class="mad-entity-header">
                                                    <a href="#" class="mad-entity-type">House For Sale</a>
                                                    <a href="#" class="mad-entity-price">$799,000</a>
                                                </header>
                                                <footer class="mad-entity-footer">
                                                    <div class="mad-entity-stat">
                                                        <span><i class="licon-bed"></i>5<span>bd</span></span>
                                                        <span><i class="licon-bathtub"></i>4<span>ba</span></span>
                                                        <span><i class="licon-rulers"></i>3650<span> sqft</span></span>
                                                    </div>
                                                </footer>
                                            </div>
                                        </article>
                                        <!--================ End of Entity ================-->
                                        <!--================ Entity ================-->
                                        <article class="mad-entity">
                                            <div class="mad-entity-media">
                                                <a href="#"><img src="/images/120x104_img2.jpg" alt=""></a>
                                                <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                            </div>
                                            <div class="mad-entity-content">
                                                <header class="mad-entity-header">
                                                    <a href="#" class="mad-entity-type">Condo/Townhome For Sale</a>
                                                    <a href="#" class="mad-entity-price">$469,900</a>
                                                </header>
                                                <footer class="mad-entity-footer">
                                                    <div class="mad-entity-stat">
                                                        <span><i class="licon-bed"></i>3<span>bd</span></span>
                                                        <span><i class="licon-bathtub"></i>3<span>ba</span></span>
                                                        <span><i class="licon-rulers"></i>2450<span> sqft</span></span>
                                                    </div>
                                                </footer>
                                            </div>
                                        </article>
                                        <!--================ End of Entity ================-->
                                        <!--================ Entity ================-->
                                        <article class="mad-entity">
                                            <div class="mad-entity-media">
                                                <a href="#"><img src="/images/120x104_img3.jpg" alt=""></a>
                                                <a href="#" class="mad-fav"><i class="material-icons">favorite_border</i></a>
                                            </div>
                                            <div class="mad-entity-content">
                                                <header class="mad-entity-header">
                                                    <a href="#" class="mad-entity-type">Apartment For Sale</a>
                                                    <a href="#" class="mad-entity-price">$520,000</a>
                                                </header>
                                                <footer class="mad-entity-footer">
                                                    <div class="mad-entity-stat">
                                                        <span><i class="licon-bed"></i>3<span>bd</span></span>
                                                        <span><i class="licon-bathtub"></i>2<span>ba</span></span>
                                                        <span><i class="licon-rulers"></i>2200<span> sqft</span></span>
                                                    </div>
                                                </footer>
                                            </div>
                                        </article>
                                        <!--================ End of Entity ================-->
                                    </div>
                                </div>
                                --}}
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- // Модальные окна
@section('modal')
    <div id="mad-property-modal" class="mad-modal">
        <div class="mad-tabs mad-tabs--style-2">
            <div class="mad-ag-wrap">
                <!--================ Tabs Navigation ================-->
                <div role="tablist" aria-label="Tabs v1" class="mad-tabs-nav">
            <span><a id="tab-41-link" href="#tab-41" role="tab" aria-selected="true" aria-controls="tab-41"
                     class="mad-tab-link">Photos</a>
            </span>
                    <span><a id="tab-43-link" href="#tab-43" role="tab" aria-selected="false" aria-controls="tab-43"
                             class="mad-tab-link">360° Virtual Tour</a>
            </span>
                    <span><a id="tab-44-link" href="#tab-44" role="tab" aria-selected="false" aria-controls="tab-44"
                             class="mad-tab-link">Street View</a>
            </span>
                    <span><a id="tab-45-link" href="#tab-45" role="tab" aria-selected="false" aria-controls="tab-45"
                             class="mad-tab-link">Map View</a>
            </span>
                    <span><a id="tab-46-link" href="#tab-46" role="tab" aria-selected="false" aria-controls="tab-46"
                             class="mad-tab-link">Schools</a>
            </span>
                    <span class="mad-active"><a id="tab-47-link" href="#tab-47" role="tab" aria-selected="false"
                                                aria-controls="tab-47" class="mad-tab-link">Neighborhood</a>
            </span>
                    <span><a id="tab-48-link" href="#tab-48" role="tab" aria-selected="false" aria-controls="tab-48"
                             class="mad-tab-link">Safety and Crime</a>
            </span>
                </div>
                <!--================ End of Tabs Navigation ================-->
                <div class="mad-col">
                    <div class="btn-set">
                        <a href="#" class="btn btn-style-3 btn-small"><i
                                class="material-icons">favorite_border</i><span>Save</span></a>
                        <a href="#" class="btn btn-style-3 btn-small"><i class="material-icons">share</i><span>Share</span></a>
                    </div>
                </div>
            </div>
            <div class="mad-tabs-container">
                <!--================ Tab ================-->
                <div id="tab-41" tabindex="0" role="tabpanel" aria-labelledby="tab-41-link" class="mad-tab">
                    <div class="row">
                        <div class="col-xl-10">
                            <div class="mad-tabbed-carousel">
                                <div class="owl-carousel with-nav type-2" id="sync3">
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img1.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img2.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img3.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img4.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img5.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img6.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img7.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img8.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img9.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img10.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img11.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img12.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img13.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img14.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img15.jpg" alt="">
                                    </div>
                                    <div class="mad-grid-item">
                                        <img src="/images/1448x744_img16.jpg" alt="">
                                    </div>
                                </div>
                                <div class="mad-tabbed-bottom">
                                    <!-- - - - - - - - - - - - - - Carousel - - - - - - - - - - - - - - - - -->
                                    <div class="owl-carousel with-nav-2 owl-theme" id="sync4">
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img1.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img2.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img3.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img4.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img5.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img6.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img7.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img8.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img9.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img10.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img11.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img12.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img13.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img14.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img15.jpg" alt="">
                                        </div>
                                        <div class="mad-grid-item">
                                            <img src="/images/104x104_img16.jpg" alt="">
                                        </div>
                                    </div>
                                    <!-- - - - - - - - - - - - - - End of Carousel - - - - - - - - - - - - - - - - -->
                                </div>
                            </div>
                        </div>
                        <aside class="col-xl-2">
                            <div class="mad-widget">
                                <h5 class="mad-widget-title">Listing Agent</h5>
                                <div class="mad-team style-4">
                                    <div class="mad-col">
                                        <!--================ Team Member ================-->
                                        <figure class="mad-team-member">
                                            <a href="javascript:void(0)" class="mad-team-member-photo"><img src="/images/120x120_photo1.jpg"
                                                                                                            alt=""></a>
                                            <figcaption class="mad-team-member-info">
                                                <div class="mad-info-wrap">
                                                    <h6 class="mad-team-member-name"><a href="#">Caroline Beek</a></h6>
                                                    <div class="mad-member-stat">Alliance Bay Realty</div>
                                                    <nav class="mad-info-block vr-list mad-links">
                                                        <ul>
                                                            <li><i class="mad-info-icon material-icons">phone</i>+1 208. 987.654</li>
                                                            <li><i class="mad-info-icon material-icons">phone_iphone</i>+1 208.654.321</li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </figcaption>
                                        </figure>
                                        <!--================ End Of Team Member ================-->
                                    </div>
                                </div>
                            </div>
                            <div class="mad-widget">
                                <h5 class="mad-widget-title">Contact The Agent</h5>
                                <form class="mad-contact-form">
                                    <input type="text" placeholder="Name">
                                    <input type="email" placeholder="Email">
                                    <input type="tel" placeholder="Phone">
                                    <textarea rows="6" placeholder="I am interested in 435 E Hudson St, Long Beach, NY 11561"></textarea>
                                    <button type="submit" class="btn btn-style-2"><i class="material-icons">mail_outline</i><span>Send
                        Message</span></button>
                                </form>
                            </div>
                        </aside>
                    </div>
                </div>
                <!--================ End of Tab ================-->
                <!--================ Tab ================-->
                <div id="tab-43" tabindex="0" role="tabpanel" aria-labelledby="tab-43-link" class="mad-tab">
                    <div class="mad-responsive-iframe">
                        <iframe width="853" height="480"
                                src="https://my.matterport.com/show/?m=JGPnGQ6hosj&utm_source=hit-content-embed"
                        ></iframe>
                    </div>
                </div>
                <!--================ End of Tab ================-->
                <!--================ Tab ================-->
                <div id="tab-44" tabindex="0" role="tabpanel" aria-labelledby="tab-44-link" class="mad-tab">
                    <div class="mad-responsive-iframe">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!4v1526278480320!6m8!1m7!1sCAoSLEFGMVFpcFBJbm9RSGxGbXhHWC1aZFhtOXhkRUhfUTVDVHRIdGdiRUpmUm5i!2m2!1d41.41745213117124!2d2.182604027161005!3f124.5!4f0!5f0.7820865974627469"
                            style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <!--================ End of Tab ================-->
                <!--================ Tab ================-->
                <div id="tab-45" tabindex="0" role="tabpanel" aria-labelledby="tab-45-link" class="mad-tab">
                    <!--================ Google Map ================-->
                    <div id="googleMap12" class="mad-gmap size-4"></div>
                </div>
                <!--================ End of Tab ================-->
                <!--================ Tab ================-->
                <div id="tab-46" tabindex="0" role="tabpanel" aria-labelledby="tab-46-link" class="mad-tab">
                    <div class="mad-toggle-section">
                        <h4 class="mad-title"><a href="#" class="mad-toggle-btn mad-title">Schools</a></h4>
                        <div class="tabs tabs-section mad-iso-tabs">
                            <!--tabs navigation-->
                            <ul class="tabs-nav">
                                <li class=""><a href="#tab-58">All</a></li>
                                <li class=""><a href="#tab-59">Elemenentary</a></li>
                                <li class=""><a href="#tab-60">Middle</a></li>
                                <li class=""><a href="#tab-61">High</a></li>
                            </ul>
                            <!--tabs content-->
                            <div class="mad-tabs-content">
                                <!--================ Tab ================-->
                                <div id="tab-58">
                                    <ul class="mad-school-list">
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--================ End of Tab ================-->
                                <!--================ Tab ================-->
                                <div id="tab-59">
                                    <ul class="mad-school-list">
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--================ End of Tab ================-->
                                <!--================ Tab ================-->
                                <div id="tab-60">
                                    <ul class="mad-school-list">
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--================ End of Tab ================-->
                                <!--================ Tab ================-->
                                <div id="tab-61">
                                    <ul class="mad-school-list">
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Brooklyn Seventh-Day Adventist School</a></h6>
                                            <p>Private - Pk-8 - 0.1 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Ps 217 Colonel David Marcus School</a></h6>
                                            <p>Public - Pk-8 - 0.3 mi</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Masores Bais Yaakov</a></h6>
                                            <p>Private - Pk-12 - 0.3 mi</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--================ End of Tab ================-->
                            </div>
                        </div>
                    </div>
                    <!--================ Google Map ================-->
                    <div id="googleMap14" class="mad-gmap size-4"></div>
                </div>
                <!--================ End of Tab ================-->
                <!--================ Tab ================-->
                <div id="tab-47" tabindex="0" role="tabpanel" aria-labelledby="tab-47-link" class="mad-tab">
                    <div class="mad-toggle-section">
                        <h4 class="mad-title"><a href="#" class="mad-toggle-btn mad-title">Neighborhood</a></h4>
                        <div class="tabs tabs-section mad-iso-tabs">
                            <!--tabs navigation-->
                            <ul class="tabs-nav">
                                <li class=""><a href="#tab-51">Highlights</a></li>
                                <li class=""><a href="#tab-52">Restaurants</a></li>
                                <li class=""><a href="#tab-53">Groceries</a></li>
                            </ul>
                            <!--tabs content-->
                            <div class="mad-tabs-content">
                                <!--================ Tab ================-->
                                <div id="tab-51">
                                    <div class="mad-entities mad-entity-hr mad-small-gap">
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img1.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Restaurants</a>
                                                        <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img2.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Nightlife</a>
                                                        <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img3.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Cafes</a>
                                                        <h6 class="mad-title"><a href="#">French Truck Coffee</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img4.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Shopping</a>
                                                        <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img1.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Restaurants</a>
                                                        <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img2.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Nightlife</a>
                                                        <h6 class="mad-title"><a href="#">La Crepe Nanou</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                    </div>
                                </div>
                                <!--================ End of Tab ================-->
                                <!--================ Tab ================-->
                                <div id="tab-52">
                                    <div class="mad-entities mad-entity-hr mad-small-gap">
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img1.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Restaurants</a>
                                                        <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img1.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Restaurants</a>
                                                        <h6 class="mad-title"><a href="#">St. James Cheese Compa- ny Uptown</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                    </div>
                                </div>
                                <!--================ End of Tab ================-->
                                <!--================ Tab ================-->
                                <div id="tab-53">
                                    <div class="mad-entities mad-entity-hr mad-small-gap">
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img4.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Shopping</a>
                                                        <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                        <div class="mad-grid-item">
                                            <!--================ Entity ================-->
                                            <article class="mad-entity">
                                                <div class="mad-entity-media">
                                                    <a href="#"><img src="/images/96x96_img4.jpg" alt=""></a>
                                                </div>
                                                <div class="mad-entity-content">
                                                    <div class="mad-entity-header">
                                                        <a href="#" class="mad-entity-type">Shopping</a>
                                                        <h6 class="mad-title"><a href="#">Mike the Bike Guy</a></h6>
                                                    </div>
                                                </div>
                                            </article>
                                            <!--================ End of Entity ================-->
                                        </div>
                                    </div>
                                </div>
                                <!--================ End of Tab ================-->
                            </div>
                            <div class="mad-text-micro">Amenity information provided by <span><img src="/images/yelp.png" alt=""></span>
                            </div>
                        </div>
                    </div>
                    <!--================ Google Map ================-->
                    <div id="googleMap11" class="mad-gmap size-4"></div>
                </div>
                <!--================ End of Tab ================-->
                <!--================ Tab ================-->
                <div id="tab-48" tabindex="0" role="tabpanel" aria-labelledby="tab-48-link" class="mad-tab">
                    <div class="mad-toggle-section">
                        <h4 class="mad-title"><a href="#" class="mad-toggle-btn mad-title">Crime</a></h4>
                        <div class="tabs tabs-section mad-iso-tabs">
                            <!--tabs navigation-->
                            <ul class="tabs-nav">
                                <li class=""><a href="#tab-54">Theft</a></li>
                                <li class=""><a href="#tab-55">Assault</a></li>
                                <li class=""><a href="#tab-56">Arest</a></li>
                                <li class=""><a href="#tab-57">Vandalism</a></li>
                            </ul>
                            <!--tabs content-->
                            <div class="mad-tabs-content">
                                <!--================ Tab ================-->
                                <div id="tab-54">
                                    <ul class="mad-school-list">
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--================ End of Tab ================-->
                                <!--================ Tab ================-->
                                <div id="tab-55">
                                    <ul class="mad-school-list">
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--================ End of Tab ================-->
                                <!--================ Tab ================-->
                                <div id="tab-56">
                                    <ul class="mad-school-list">
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--================ End of Tab ================-->
                                <!--================ Tab ================-->
                                <div id="tab-57">
                                    <ul class="mad-school-list">
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sat Nov 23 2019</a> </h6>
                                            <p>SIMPLE BATTERY. DISPOSITION: GONE
                                                ON ARRIVAL (GOA)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>THEFT. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Mon Nov 25 2019</a></h6>
                                            <p>SHOPLIFTING. DISPOSITION: REPORT TO FOLLOW (RTF)</p>
                                        </li>
                                        <li>
                                            <h6 class="mad-title"><a href="#" class="mad-link">Sun Nov 24 2019</a></h6>
                                            <p>FIGHT. DISPOSITION: GONE ON ARRIVAL (GOA)</p>
                                        </li>
                                    </ul>
                                </div>
                                <!--================ End of Tab ================-->
                            </div>
                        </div>
                    </div>
                    <!--================ Google Map ================-->
                    <div id="googleMap13" class="mad-gmap size-4"></div>
                </div>
                <!--================ End of Tab ================-->
            </div>
            <!--================ End of Tabs Container ================-->
        </div>
        <button class="arcticmodal-close"><i class="material-icons">close</i></button>
    </div>
@endsection
--}}

@section('js')
    @if(!empty($latitude) && !empty($longitude))
        <script src="https://www.openlayers.org/api/OpenLayers.js"></script>
        <script type="text/javascript">
            map = new OpenLayers.Map("mapdiv");
            map.ImgPath = "/img/markers/";
            map.addLayer(new OpenLayers.Layer.OSM());

            var lonLat = new OpenLayers.LonLat({{ $longitude }}, {{ $latitude }})
                .transform(
                    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                    map.getProjectionObject() // to Spherical Mercator Projection
                );
            var zoom = 15;

            var markers = new OpenLayers.Layer.Markers("Markers");
            map.addLayer(markers);
            var size = new OpenLayers.Size(37, 42);
            var offset = new OpenLayers.Pixel(-(size.w / 2), -size.h);
            var icon = new OpenLayers.Icon('/img/markers/map_marker.png', size, offset);
            markers.addMarker(new OpenLayers.Marker(lonLat, icon));
            {{--
            var pois = new OpenLayers.Layer.Text("My Points",
                {
                    location: "/storage/textfile.txt",
                    projection: map.displayProjection
                });
            map.addLayer(pois);

            // create layer switcher widget in top right corner of map.
            var layer_switcher = new OpenLayers.Control.LayerSwitcher({});
            map.addControl(layer_switcher);
            --}}

            map.setCenter(lonLat, zoom);
        </script>
    @endif
@endsection
