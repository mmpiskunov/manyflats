@guest
    <a href="#tab-login" class="mad-link" data-arctic-modal="#mad-auth-modal">
        {{ trans('layouts/auth.login') }}
    </a>
    /
    <a href="#tab-reg" class="mad-link" data-arctic-modal="#mad-auth-modal">
        {{ trans('layouts/auth.register') }}
    </a>
@else
    <span class="mad-link">
        {{ Auth::user()->name }}
    </span>
    @if(empty(Auth::user()->email_verified_at))
        <span class="text-danger">{{ trans('layouts/auth.not_verified') }}</span>
    @endif
    /
    <a href="{{ route('logout') }}" class="mad-link"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        {{ trans('layouts/auth.logout') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endif

@section('auth-modal')
    <div id="mad-auth-modal" class="mad-modal" style="max-width:540px; margin-left: auto; margin-right: auto;">
        <div class="mad-tabs mad-tabs--style-2">
            <div class="mad-ag-wrap">
                <!--================ Tabs Navigation ================-->
                <div role="tablist" aria-label="Tabs v1" class="mad-tabs-nav">
                    <span>
                        <a id="tab-login-link" href="#tab-login" role="tab" aria-selected="true"
                           aria-controls="tab-login"
                           class="mad-tab-link"
                           onclick="$('#tab-login').show();$('#tab-reg').hide();$('#tab-reset').hide();">
                            {{ trans('layouts/auth.login') }}
                        </a>
                    </span>
                    <span>
                        <a id="tab-reg-link" href="#tab-reg" role="tab" aria-selected="false" aria-controls="tab-reg"
                           class="mad-tab-link"
                           onclick="$('#tab-login').hide();$('#tab-reg').show();$('#tab-reset').hide();">
                            {{ trans('layouts/auth.register') }}
                        </a>
                    </span>
                </div>
            </div>
            <div class="mad-tabs-container">
                <div id="tab-login" tabindex="0" role="tabpanel" aria-labelledby="tab-login-link" class="mad-tab">
                    <h4 class="mad-title">{{ trans('layouts/auth.login_topic') }}</h4>
                    <form method="POST" action="{{ route('login') }}" class="mad-contact-form">
                        @csrf
                        <input name="email" type="email" placeholder="{{ trans('layouts/auth.email') }}"
                               required autocomplete="email">
                        <input name="password" type="password" placeholder="{{ trans('layouts/auth.password') }}"
                               required autocomplete="current-password">
                        <div class="form-control" style="margin-bottom: 1rem;">
                            <input type="checkbox" name="remember" value="1" id="remember" checked="checked">
                            <label for="remember">{!! trans('layouts/auth.remember_me') !!}</label>
                        </div>
                        <button type="submit" class="btn btn-style-2" style="margin-bottom: 1rem;">
                            <span>{{ trans('layouts/auth.login_button') }}</span>
                        </button>
                        <button type="button" class="btn btn-style-3" onclick="window.location.href='{{ route('password.request') }}'">
                            <span>{{ trans('layouts/auth.forgot') }}</span>
                        </button>
                    </form>
                </div>
                <div id="tab-reg" tabindex="0" role="tabpanel" aria-labelledby="tab-reg-link" class="mad-tab">
                    <h4 class="mad-title">{{ trans('layouts/auth.register_topic') }}</h4>
                    <form method="POST" action="{{ route('register') }}" class="mad-contact-form">
                        @csrf
                        <input type="text" placeholder="{{ trans('layouts/auth.name') }}" name="name" required
                               autocomplete="name">
                        <input type="email" placeholder="{{ trans('layouts/auth.email') }}" name="email" required
                               autocomplete="email">
                        <input type="password" placeholder="{{ trans('layouts/auth.password') }}" name="password"
                               required autocomplete="new-password">
                        <input type="password" placeholder="{{ trans('layouts/auth.confirm_password') }}"
                               name="password_confirmation" required autocomplete="new-password">
                        <div class="form-control" style="margin-bottom: 1rem;">
                            <input type="checkbox" name="agree" value="1" id="agree" checked="checked" required>
                            <label for="agree">{!! trans('layouts/auth.agree', ['link' => '#']) !!}</label>
                        </div>
                        <button type="submit" class="btn btn-style-2" style="margin-bottom: 1rem;">
                            <span>{{ trans('layouts/auth.register_button') }}</span>
                        </button>
                        <button type="button" class="btn btn-style-3" onclick="window.location.href='{{ route('password.request') }}'">
                            <span>{{ trans('layouts/auth.forgot') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <button class="arcticmodal-close"><i class="material-icons">close</i></button>
    </div>
@endsection
