@extends('design.main.app')
@section('title', trans('containers/media.title'))
@section('css')
@endsection

@section('content')
    @include('containers.media')
    <div class="mad-content no-pd">
        <div class="container mobile-full-width">
            {{-- @include('containers.explore') --}}
            @include('containers.latest')
            {{-- @include('containers.agent') --}}
            {{-- @include('containers.sales') --}}
            {{-- @include('containers.loan') --}}
            {{-- @include('containers.news') --}}
            {{-- @include('containers.partners') --}}
        </div>
    </div>
@endsection

@section('js')
@endsection
