<header id="mad-header" class="mad-header">
    <div class="mad-header-section mad-header-section--sticky-xl">
        <div class="mad-header-col hide-mobile">
            <a href="{{ route('public.index') }}">
                <img src="/img/logo.png" width="180" height="45" alt="{{ config('app.name', '') }}">
            </a>
        </div>
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
    </div>
</header>
