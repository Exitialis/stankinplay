@extends('vendor.index')

@section('content')
    <div class="row">
        <div class="col-md-3 col-xs-12">
            @include('profile.menu')
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 well">
            @yield('profile')
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection