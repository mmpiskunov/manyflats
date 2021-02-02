@guest
@else
    @if(empty(Auth::user()->email_verified_at))
        <div class="mad-alert-box--info" style="margin-bottom: 2rem">
            <div class="mad-alert-box-inner">
                {{ trans('layouts/auth.verify') }}
            </div>
        </div>
    @endif
@endif
