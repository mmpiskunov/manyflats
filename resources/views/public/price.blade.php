@extends('design.list.app')
@section('title', $title ?? trans('public/price.title'))

@section('content')
    @include('layouts.search')

    <div class="mad-content no-pt">
        <div class="container">
            <div class="content-element-6">
                <h3 class="mad-page-title">{{ trans('public/price.topic') }}</h3>
                <!--================ Pricing Tables ================-->
                <div class="mad-pricing-tables item-col-3 no-gutters">
                    <div class="mad-col">
                        <!--================ Pricing Table ================-->
                        <article class="mad-pricing-table">
                            <div class="mad-pricing-table-content">
                                <span class="mad-pt-icon">
                                    <img src="/svg/basic_house.svg" alt="{{ trans('public/price.free') }}" class="svg">
                                </span>
                                <h2 class="mad-pricing-table-title">{{ trans('public/price.free') }}</h2>
                                <strong class="mad-pricing-table-price">0.00<span>/{{ trans('public/price.month') }}</span></strong>
                                <div class="mad-pricing-table-text">{!! trans('public/price.free_description') !!}</div>
                                <span class="btn btn-style-1"><span>{{ trans('public/price.on') }}</span><i class="material-icons">arrow_forward_ios</i></span>
                            </div>
                        </article>
                        <!--================ End Of Pricing Table ================-->
                    </div>
                    <div class="mad-col">
                        <!--================ Pricing Table ================-->
                        <article class="mad-pricing-table mad-pt-selected">
                            <div class="mad-pricing-table-content">
                                <span class="pt-label">{{ trans('public/price.recommended') }}</span>
                                <span class="mad-pt-icon">
                                    <img src="/svg/standard_house.svg" alt="{{ trans('public/price.standard') }}" class="svg">
                                </span>
                                <h2 class="mad-pricing-table-title">{{ trans('public/price.standard') }}</h2>
                                <strong class="mad-pricing-table-price">199.00<span>/{{ trans('public/price.month') }}</span></strong>
                                <div class="mad-pricing-table-text">{!! trans('public/price.standard_description') !!}</div>
                                <a href="{{ route('public.buy', ['id' => 1]) }}" class="btn btn-style-2"><span>{{ trans('public/price.buy') }}</span><i class="material-icons">arrow_forward_ios</i></a>
                            </div>
                        </article>
                        <!--================ End Of Pricing Table ================-->
                    </div>
                    <div class="mad-col">
                        <!--================ Pricing Table ================-->
                        <article class="mad-pricing-table">
                            <div class="mad-pricing-table-content">
                                <span class="mad-pt-icon">
                                    <img src="/svg/premium_house.svg" alt="{{ trans('public/price.premium') }}" class="svg">
                                </span>
                                <h2 class="mad-pricing-table-title">{{ trans('public/price.premium') }}</h2>
                                <strong class="mad-pricing-table-price">999.00<span>/{{ trans('public/price.year') }}</span></strong>
                                <div class="mad-pricing-table-text">{!! trans('public/price.premium_description') !!}</div>
                                <a href="{{ route('public.buy', ['id' => 2]) }}" class="btn btn-style-2"><span>{{ trans('public/price.buy') }}</span><i class="material-icons">arrow_forward_ios</i></a>
                            </div>
                        </article>
                        <!--================ End Of Pricing Table ================-->
                    </div>
                </div>
                <!--================ End Of Pricing Tables ================-->
            </div>
        </div>
    </div>
@endsection
