@extends('layouts.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Add property</h1>
        @include('layouts.languages')
    </div>
    <div class="separator-breadcrumb border-top"></div>

    @include('layouts.status')

    <div class="row mb-3">
        <div class="card-body">
            <form action="{{route('properties.store')}}" method="post" class="js-form">
                @csrf
                <div class="row">
                    <div class="card-body">

                        @include('layouts.crud.edit.form')

                        <div class="col-md-12 mt-2">
                            <button type="submit" class="btn btn-primary">
                                Add property
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('page-js')
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
@endsection
