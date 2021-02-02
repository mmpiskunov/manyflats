@include('design.counter')

<!--================ Footer ================-->
<footer id="mad-footer" class="mad-footer style-3">
    <div class="container">
        <!--================ Footer row ================-->
        <div class="mad-footer-main">
            {{--
            <div class="content-element-2">
                <nav class="hr-list tt-up mad-links link-white-2">
                    <ul class="justify-content-center">
                        <li><a href="{{ route('public.about') }}">{{ trans('design/footer.menu.about') }}</a></li>
                        <li><a href="{{ route('properties.create') }}">{{ trans('design/footer.menu.sell') }}</a></li>
                        <li><a href="{{ route('properties.index') }}">{{ trans('design/footer.menu.buy') }}</a></li>
                        <li><a href="{{ route('testimonials') }}">{{ trans('design/footer.menu.testimonials') }}</a></li>
                        <li><a href="{{ route('news') }}">{{ trans('design/footer.menu.news') }}</a></li>
                        <li><a href="{{ route('public.contact') }}">{{ trans('design/footer.menu.contact') }}</a></li>
                    </ul>
                </nav>
            </div>
            --}}
            <div class="content-element-2">
                <nav class="hr-list mad-soc-icons white-icons big-icons">
                    <ul class="justify-content-center">
                        <li><a href="{{ trans('common.facebook_url') }}" target="_blank"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a href="{{ trans('common.telegram_url') }}" target="_blank"><i class="fab fa-telegram-plane"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!--================ End of Footer row ================-->
        <div class="mad-bottom-footer">
            {{--
            <div class="content-element-2">
                <nav class="mad-info-block hr-list mad-links link-white">
                    <ul class="justify-content-between">
                        <li><i class="mad-info-icon material-icons">room</i>{{ trans('common.address') }}</li>
                        <li><i class="mad-info-icon material-icons">phone_iphone</i>{{ trans('common.phone') }}</li>
                        <li><i class="mad-info-icon material-icons">mail_outline</i><a href="#" style="background-position: 0% 31px;">{{ trans('common.email') }}</a></li>
                        <li><i class="mad-info-icon material-icons">access_time</i>{{ trans('common.working_hours') }}</li>
                    </ul>
                </nav>
            </div>
            --}}
            <div class="content-element-2">
                <div class="align-center">
                    <p>{{ trans('design/footer.term') }}</p>
                    <p class="copyrights">
                        {{ trans('design/footer.copyright') }} &copy;
                        @if (date('Y') != 2020) {{ '2020-' . date('Y') }} @else 2020 @endif
                        <a href="{{ route('public.about') }}" class="mad-link link-white">{{ trans('common.name') }}</a>.
                        {{ trans('design/footer.all_rights') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--================ End of Footer ================-->
