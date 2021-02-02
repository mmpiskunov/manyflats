@extends('design.list.app')
@section('title', $title ?? trans('public/about.title'))

@section('content')
    @include('layouts.search')

    <div class="mad-content no-pt">
        <div class="container">
            <div class="content-element-6">
                <h3 class="mad-page-title">{{ trans('public/about.topic') }}</h3>
                <!--================ Counters ================-->
                <section class="mad-counter-section no-icons mad-section mad-section--stretched mad-colorizer--scheme-color-2">
                    <!--================ Counters ================-->
                    <div class="mad-counters style-2 item-col-4">
                        <div class="mad-col">
                            <div class="mad-counter">
                                <div class="mad-counter-inner">
                                    <div class="mad-counter-icon"><img class="svg" src="/svg/for_sale.svg" alt=""></div>
                                    <div class="mad-counter-content">
                                        <div aria-labelledby="counter-1" class="mad-counter-count">{{ $properties ?? 0 }}</div>
                                        <div id="counter-5" class="mad-counter-title">{{ trans('public/about.flats_for_sale') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mad-col">
                            <div class="mad-counter">
                                <div class="mad-counter-inner">
                                    <div class="mad-counter-icon"><img class="svg" src="/svg/open_house.svg" alt=""></div>
                                    <div class="mad-counter-content">
                                        <div aria-labelledby="counter-2" class="mad-counter-count">{{ $users ?? 0 }}</div>
                                        <div id="counter-6" class="mad-counter-title">{{ trans('public/about.users') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mad-col">
                            <div class="mad-counter">
                                <div class="mad-counter-inner">
                                    <div class="mad-counter-icon"><img class="svg" src="/svg/city.svg" alt=""></div>
                                    <div class="mad-counter-content">
                                        <div aria-labelledby="counter-3" class="mad-counter-count">{{ $countries ?? 0 }}</div>
                                        <div id="counter-7" class="mad-counter-title">{{ trans('public/about.countries') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mad-col">
                            <div class="mad-counter">
                                <div class="mad-counter-inner">
                                    <div class="mad-counter-icon"><img class="svg" src="/svg/premium_house2.svg" alt=""></div>
                                    <div class="mad-counter-content">
                                        <div aria-labelledby="counter-4" class="mad-counter-count">{{ $cities ?? 0 }}</div>
                                        <div id="counter-8" class="mad-counter-title">{{ trans('public/about.cities') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--================ End of Counters ================-->
                </section>
            </div>
        </div>
    </div>
@endsection
