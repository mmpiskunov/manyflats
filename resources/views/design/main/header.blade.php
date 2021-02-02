<!--================ Header ================-->
<header id="mad-header" class="mad-header header-3 header-white mad-header--transparent mad-header--transparent-single">
    {{--
    <div class="mad-top-header">
        <div class="container">
            <div class="mad-top-header-wrap">
                <!--================ Column ================-->
                <div class="mad-header-col">
                    <nav class="mad-info-block hr-list">
                        <ul>
                            <li><i class="mad-info-icon material-icons">phone</i><a
                                    href="{{ route('public.contact') }}">{{ trans('common.phone') }}</a></li>
                            <li><i class="mad-info-icon material-icons">mail_outline</i><a
                                    href="{{ route('public.contact') }}">{{ trans('header.subscribe') }}</a></li>
                        </ul>
                    </nav>
                </div>

                <!--================ End of Column ================-->
                <!--================ Column ================-->
                <div class="mad-header-col">
                    <nav class="hr-list mad-soc-icons">
                        <ul>
                            <li><a href="{{ trans('common.facebook_url') }}" target="_blank"><i
                                        class="fab fa-facebook-square"></i></a></li>
                            <li><a href="{{ trans('common.telegram_url') }}" target="_blank"><i
                                        class="fab fa-telegram"></i></a></li>
                        </ul>
                    </nav>
                </div>
                <!--================ End of Column ================-->
            </div>
        </div>
    </div>
    --}}
    <!--================ Section ================-->
    <div class="mad-header-section mad-header-section--sticky-xl">
        <div class="container">
            <!--================ Column ================-->
            <div class="mad-header-col hide-mobile">
                <a href="{{ route('public.index') }}">
                    <img src="/img/logo.png" width="180" height="45" alt="{{ config('app.name', '') }}">
                </a>
            </div>
            <!--================ End of Column ================-->
            <!--================ Column ================-->
            <div class="mad-header-col">
                <div class="mad-header-items">
                    <div class="mad-header-item">
                        @include('design.menu')
                    </div>
                    <div class="mad-header-item">
                        <div class="mad-header-buttons">
                            <div class="mad-sing">
                                @include('design.login')
                            </div>
                            {{--
                            <a href="{{ route('properties.create') }}" class="btn">
                                <i class="material-icons">control_point</i><span>{{ trans('layouts/menu.add_property') }}</span>
                            </a>
                            --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--================ End of Column ================-->
        </div>
    </div>
    <!--================ End of Section ================-->
</header>
<!--================ End of Header ================-->
