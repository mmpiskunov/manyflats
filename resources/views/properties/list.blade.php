@extends('design.list.app')
@section('title', $title ?? trans('properties/list.title'))
@php($oldDate = date("Y-m-d H:i:s", time()-2 * 24 * 60 * 60))

@section('content')
    @include('layouts.search')

    <div class="mad-full-page-wrap">
        <div class="mad-main-page">

            <div class="mad-breadcrumb style-2">
                <div class="container full-width">
                    <div class="mad-breadcrumb-wrap">
                        @if(empty($find))
                            <div class="mad-col">
                                <nav class="mad-breadcrumb-path hide-mobile">
                                    <span><a href="{{ route('public.index') }}">{{ trans('layouts/menu.home') }}</a></span>
                                    @if (!empty($country))
                                        @if (!empty($city))
                                            / <span><a
                                                    href="{{ route('properties.country', ['country' => $country]) }}">{{ trans('countries.name.' . $country) }}</a></span>
                                        @else
                                            / <span>{{ trans('countries.name.' . $country) }}</span>
                                        @endif
                                    @endif
                                    @if (!empty($city))
                                        @if (!empty($district))
                                            / <span><a
                                                    href="{{ route('properties.city', ['country' => $country, 'city' => $city]) }}">{{ trans('feeds/districts.city.' . $city . '.name') }}</a></span>
                                        @else
                                            / <span>{{ trans('feeds/districts.city.' . $city . '.name') }}</span>
                                        @endif
                                    @endif
                                    @if (!empty($district))
                                        / <span>{{ trans('feeds/districts.city.' . $city . '.' . $district) }}</span>
                                    @endif
                                </nav>
                                <h1 class="mad-page-title">{{ trans('properties/list.title') }}</h1>
                            </div>
                        @endif
                        {{--
                        <div class="product-sort-section">
                            <div class="mad-col">
                                <span>Sort by:</span>
                                <div class="mad-custom-select size-2">
                                    <select data-default-text="Relevant Listings">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        --}}
                    </div>
                </div>
            </div>

            <div class="mad-content no-pt">
                <div class="container full-width mobile-full-width">
                    <div id="product-holder" class="mad-entities item-col-4">
                        @foreach($records as $record)
                            <div class="mad-col">
                                <!--================ Entity ================-->
                                <article class="mad-entity">
                                    <div class="mad-entity-media">
                                        <div class="mad-grid mad-grid--cols-1">
                                            <a href="{{ route('properties.show', ['country' => $record->country, 'city' => $record->city, 'district' => $record->district, 'id' => $record->id]) }}">
                                                <img
                                                    src="{{ route('feed.property.picture.small', ['language' => $language, 'id' => $record->id, 'width' => 450]) }}"
                                                    alt="{{ $record->address }}">
                                            </a>
                                        </div>
                                        @if ($record->created_at > $oldDate)
                                            <div class="mad-label"><span
                                                    class="mad-new">{{ trans('properties/list.new') }}</span></div>
                                        @endif
                                    </div>
                                    <div class="mad-entity-content">
                                        <header class="mad-entity-header">
                                            {{--
                                            <span href="{{ route('properties.district', ['country' => $record->country, 'city' => $record->city, 'district' => $record->district]) }}" class="mad-entity-type">
                                                {{ trans('feeds/districts.city.' . $record->city . '.' . $record->district) }}
                                            </span>
                                            --}}
                                            <span class="mad-entity-price">{{ number_format($record['price'], 0, '.', ' ') }} €</span>
                                        </header>
                                        {{--
                                        <div class="mad-entity-body">
                                            <p class="mad-adress">338 Spear St Unit 21F, San Francisco, CA 94105</p>
                                        </div>
                                        --}}
                                        <footer class="mad-entity-footer">
                                            <div class="mad-entity-stat">
                                                <span>
                                                    <i class="licon-city"></i>
                                                    <a href="{{ route('properties.district', ['country' => $record->country, 'city' => $record->city, 'district' => $record->district]) }}">{{ trans('feeds/districts.city.' . $record->city . '.' . $record->district) }}</a>
                                                </span>
                                                <span>
                                                    <i class="licon-apartment"></i>
                                                    {{ $record['floor'] }}/{{ $record['floors'] }}
                                                </span>
                                                <span>
                                                    <i class="licon-bed"></i>
                                                    {{ $record['rooms'] }}{{ trans('common.bedrooms') }}
                                                </span>
                                                <span>
                                                    <i class="licon-rulers"></i>
                                                    {{ number_format($record['space'], 0) }} {{ trans('common.m2') }}
                                                </span>
                                            </div>
                                        </footer>
                                        <div class="mad-prop">Polo Real Estate Group LLC</div>
                                    </div>
                                </article>
                                <!--================ End of Entity ================-->
                            </div>
                        @endforeach
                    </div>

                    {{ $records->appends($input['page'] ?? [])->links() }}

                </div>
            </div>
@endsection
