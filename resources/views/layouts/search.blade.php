<!--================ Search panel ================-->
<div class="mad-search-section hide-mobile">
    <div class="container @if (!empty($find)) full-width @endif">
        @include('layouts.email_verified')
        <form action="{{ route('properties.search') }}" class="mad-search">
            <div class="mad-search-item">
                <input name="keywords" type="text" value="{{ $keywords ?? '' }}" placeholder="{{ trans('containers/media.placeholder') }}">
            </div>
            <div class="mad-search-item">
                <div class="mad-custom-select">
                    <select name="rooms" data-default-text="{{ trans('properties/search.rooms') }}">
                        <option value="">{{ trans('properties/search.default') }}</option>
                        <option value="1" @if(!empty($find) && isset($rooms) && $rooms == 1) selected @endif>{{ trans('properties/search.1flat') }}</option>
                        <option value="2" @if(!empty($find) && isset($rooms) && $rooms == 2) selected @endif>{{ trans('properties/search.2flat') }}</option>
                        <option value="3" @if(!empty($find) && isset($rooms) && $rooms == 3) selected @endif>{{ trans('properties/search.3flat') }}</option>
                        <option value="4" @if(!empty($find) && isset($rooms) && $rooms == 4) selected @endif>{{ trans('properties/search.4flat') }}</option>
                    </select>
                </div>
            </div>
            <div class="mad-search-item">
                <div class="mad-custom-select">
                    <select name="floors" data-default-text="{{ trans('properties/search.floors') }}">
                        <option value="">{{ trans('properties/search.default') }}</option>
                        <option value="1" @if(isset($floors) && $floors == 1) selected @endif>{{ trans('properties/search.floors5') }}</option>
                        <option value="2" @if(isset($floors) && $floors == 2) selected @endif>{{ trans('properties/search.floors6_9') }}</option>
                        <option value="3" @if(isset($floors) && $floors == 3) selected @endif>{{ trans('properties/search.floors10') }}</option>
                    </select>
                </div>
            </div>
            <div class="mad-search-item">
                <div class="mad-custom-select">
                    <select name="space" data-default-text="{{ trans('properties/search.space') }}">
                        <option value="">{{ trans('properties/search.default') }}</option>
                        <option value="1" @if(isset($space) && $space == 1) selected @endif>{{ trans('properties/search.space40') }}</option>
                        <option value="2" @if(isset($space) && $space == 2) selected @endif>{{ trans('properties/search.space40_80') }}</option>
                        <option value="3" @if(isset($space) && $space == 3) selected @endif>{{ trans('properties/search.space80') }}</option>
                    </select>
                </div>
            </div>
            <div class="mad-search-item">
                <div class="mad-custom-select">
                    <select name="price" data-default-text="{{ trans('properties/search.price') }}">
                        <option value="">{{ trans('properties/search.default') }}</option>
                        <option value="1" @if(isset($price) && $price == 1) selected @endif>{{ trans('properties/search.price50') }}</option>
                        <option value="2" @if(isset($price) && $price == 2) selected @endif>{{ trans('properties/search.price50_100') }}</option>
                        <option value="3" @if(isset($price) && $price == 3) selected @endif>{{ trans('properties/search.price100') }}</option>
                    </select>
                </div>
            </div>
            <div class="mad-search-item">
                <div class="mad-custom-select">
                    <select name="payback" data-default-text="{{ trans('properties/search.payback') }}">
                        <option value="">{{ trans('properties/search.default') }}</option>
                        <option value="1" @if(isset($payback) && $payback == 1) selected @endif>{{ trans('properties/search.payback10') }}</option>
                        <option value="2" @if(isset($payback) && $payback == 2) selected @endif>{{ trans('properties/search.payback10_15') }}</option>
                        <option value="3" @if(isset($payback) && $payback == 3) selected @endif>{{ trans('properties/search.payback15') }}</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="find" value="1">
            <div class="mad-search-item">
                <button type="submit" class="btn btn-style-2 btn-big">
                    <i class="material-icons">search</i>
                    <span>{{ trans('properties/search.button') }}</span>
                </button>
            </div>
        </form>
    </div>
</div>
<!--================ End of Search panel ================-->
