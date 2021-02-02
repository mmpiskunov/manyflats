@extends('design.list.app')
@section('title', $title ?? trans('auth/register.title'))

@section('content')
    <div class="mad-content no-pt">
        <div class="container">
            <div class="content-element-6">

                <div class="mad-widget" style="max-width:640px; margin: 3rem auto 5rem auto">
                    <h3 class="mad-widget-title">{{ trans('auth/register.topic') }}</h3>

                    <form method="POST" action="{{ route('register') }}" class="mad-contact-form">
                        @csrf

                        @error('name')
                            <div role="alert" class="mad-alert-box mad-alert-box--warning" style="margin-bottom: 2rem">
                                <div class="mad-alert-box-inner">
                                    {{ $message }}
                                </div>
                            </div>
                        @enderror
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

                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="{{ trans('auth/register.name') }}"
                               required autocomplete="name" autofocus>

                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="{{ trans('auth/register.email') }}"
                               required autocomplete="email">

                        <input id="password" name="password" type="password" placeholder="{{ trans('auth/register.password') }}"
                               required autocomplete="new-password">

                        <input id="password-confirm" name="password_confirmation" type="password" placeholder="{{ trans('auth/register.confirm_password') }}"
                               required autocomplete="new-password">

                        <button type="submit" class="btn btn-style-2">
                            {{ trans('auth/register.button') }}
                        </button>

                        <button type="button" class="btn btn-style-3" onclick="window.location.href='{{ route('login') }}'">
                            <span>{{ trans('auth/login.button') }}</span>
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
