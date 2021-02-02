<!--================ Media element ================-->
<div class="mad-media-element type-2" data-bg-image-src="/img/bg.jpg">
    <div class="mad-media-inner">
        <h1 class="text-white">{!! trans('containers/media.title') !!}</h1>
        @include('layouts.email_verified')
        <p>{{ trans('containers/media.subtitle') }}</p>

        <!--================ Search panel ================-->
        <div class="mad-search-section">
            <div class="container">
                <!--================ Tabs ================-->
                <div class="mad-tabs">
                    {{--
                    <!--================ Tabs Navigation ================-->
                    <div role="tablist" aria-label="Tabs v1" class="mad-tabs-nav">
                        <span class="mad-active">
                            <a id="tab-1-link" href="#tab-1" role="tab" aria-selected="false" aria-controls="tab-1" class="mad-tab-link">
                                {{ trans('home.media.tabs.buy') }}
                            </a>
                        </span>
                        <span>
                            <a id="tab-2-link" href="#tab-2" role="tab" aria-selected="true" aria-controls="tab-2" class="mad-tab-link">
                                {{ trans('home.media.tabs.rent') }}
                            </a>
                        </span>
                        <span>
                            <a id="tab-3-link" href="#tab-3" role="tab" aria-selected="false" aria-controls="tab-3" class="mad-tab-link">
                                Sold
                            </a>
                        </span>
                    </div>
                    <!--================ End of Tabs Navigation ================-->
                    --}}
                    <!--================ Tabs Container ================-->
                    <div class="mad-tabs-container">
                        <!--================ Tab ================-->
                        <div id="tab-1" tabindex="0" role="tabpanel" aria-labelledby="tab-1-link" class="mad-tab">
                            <form action="{{ route('properties.search') }}" class="mad-search">
                                <div class="mad-search-item with-search-btn">
                                    <input name="keywords" type="text" placeholder="{{ trans('containers/media.placeholder') }}">
                                    <button type="submit" class="btn btn-style-2 search-button">
                                        <i class="icon material-icons">search</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--================ End of Tab ================-->
                        {{--
                        <!--================ Tab ================-->
                        <div id="tab-2" tabindex="0" role="tabpanel" aria-labelledby="tab-2-link" class="mad-tab">
                            <form class="mad-search">
                                <div class="mad-search-item with-search-btn">
                                    <input type="text" placeholder="{{ trans('home.media.placeholder') }}">
                                    <button type="submit" class="btn btn-style-2 search-button">
                                        <i class="icon material-icons">search</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--================ End of Tab ================-->
                        <!--================ Tab ================-->
                        <div id="tab-3" tabindex="0" role="tabpanel" aria-labelledby="tab-3-link" class="mad-tab">
                            <form class="mad-search">
                                <div class="mad-search-item with-search-btn">
                                    <input type="text" placeholder="Location, zip, address or MLS #">
                                    <button type="submit" class="btn btn-style-2 search-button">
                                        <i class="icon material-icons">search</i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--================ End of Tab ================-->
                        --}}
                    </div>
                    <!--================ End of Tabs Container ================-->
                </div>
            </div>
        </div>
    </div>
</div>
