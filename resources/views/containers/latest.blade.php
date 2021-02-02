<div class="mad-section style-3 size-2 pt-1 mobile-top-bottom">
    <div class="mad-title-wrap vr-type">
        <h2 class="mad-title">{{ trans('containers/latest.title') }}</h2>
        <p class="hide-mobile">{{ trans('containers/latest.description') }}</p>
    </div>

    <div class="mad-tabs-container">
        <!--================ Tab ================-->
        <div id="tab-all" tabindex="1" role="tabpanel" aria-labelledby="tab-all-link" class="mad-tab">
            <div class="mad-entities mad-entities-type-1 item-col-3">
                @foreach ($pictures as $pictureData)
                    <div class="mad-grid-item">
                        <article class="mad-entity">
                            <div class="mad-entity-media">
                                <div class="mad-grid mad-grid--cols-1">
                                    <a href="{{ route('properties.country', ['country' => $pictureData['country']]) }}">
                                        <img
                                            src="{{ route('feed.property.picture.small', ['language' => $language, 'id' => $pictureData['id'], 'width' => 450]) }}"
                                            alt="{{ trans('feeds/districts.city.' . $pictureData['city'] . '.name') }}">
                                    </a>
                                </div>
                            </div>
                            <div class="mad-entity-content">
                                <header class="mad-entity-header">
                                    <a href="{{ route('properties.country', ['country' => $pictureData['country']]) }}"
                                       class="mad-entity-price">{{ trans('countries.name.' . $pictureData['country']) }}</a>
                                </header>
                                <footer class="mad-entity-footer">
                                    <p class="mad-adress">
                                        @foreach($countries[$pictureData['country']] as $i => $cityName)@if($i), @endif<a href="{{ route('properties.city', ['country' => $pictureData['country'], 'city' => $cityName]) }}">{{ trans('feeds/districts.city.' . $cityName . '.name') }}</a>@endforeach
                                    </p>
                                </footer>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
