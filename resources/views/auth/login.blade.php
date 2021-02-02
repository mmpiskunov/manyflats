@extends('design.list.app')
@section('title', $title ?? trans('auth/login.title'))

@section('content')
    <div class="mad-content no-pt">
        <div class="container">
            <div class="content-element-6">

                <div class="mad-widget" style="max-width:540px; margin: 3rem auto 5rem auto">
                    <h3 class="mad-widget-title">{{ trans('auth/login.topic') }}</h3>

                    <form method="POST" action="{{ route('login') }}" class="mad-contact-form">
                        @csrf
                        @error('email')
                            <div role="alert" class="mad-alert-box mad-alert-box--warning" style="margin-bottom: 2rem">
                                <div class="mad-alert-box-inner">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
                        @error('password')
                            <div role="alert" class="mad-alert-box mad-alert-box--warning" style="margin-bottom: 2rem">
                                <div class="mad-alert-box-inner">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror

                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="{{ trans('auth/login.email') }}"
                               required autocomplete="email" autofocus>

                        <input name="password" type="password" placeholder="{{ trans('auth/login.password') }}"
                               required autocomplete="current-password">

                        <div class="form-group" style="margin-left:0">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" checked="checked">
                            <label class="form-check-label" for="remember">
                                {{ trans('auth/login.remember_me') }}
                            </label>
                        </div>

                        <button type="submit" class="btn btn-style-2">
                            {{ trans('auth/login.button') }}
                        </button>

                        <button type="button" class="btn btn-style-3" onclick="window.location.href='{{ route('register') }}'">
                            <span>{{ trans('auth/login.register') }}</span>
                        </button>

                        <button type="button" class="btn btn-style-3" onclick="window.location.href='{{ route('password.request') }}'">
                            <span>{{ trans('auth/login.forgot') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
