@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>
            <li>Edit property</li>
        </h1>
        <ul>
            <li><a href="{{route('properties.show', $id)}}">{{ $name ?? '' }}</a></li>
            <li><a href="{{route('properties.index')}}">Properties</a></li>
        </ul>
        @include('layouts.languages')
    </div>
    <div class="separator-breadcrumb border-top"></div>

    @include('layouts.status')

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card-title mb-3">{{ $name ?? '' }} (ID: {{ $id }})</div>
                    </div>
                    <div class="col-md-2 text-right">
                        <form action="{{route('properties.destroy', $id)}}" method="post"
                              onsubmit="return confirm('Really delete?');">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-dark">Delete</button>
                        </form>
                    </div>
                </div>

                <form action="{{route('properties.update', $id)}}" method="post" class="js-form">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="card-body">
                            <div class="col-xl-8 offset-xl-right-4 col-lg-12">
                                @include('layouts.crud.edit.form')
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
@endsection
