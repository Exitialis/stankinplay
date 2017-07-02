@extends('vendor.index')

@section('content')
    
    <div class="row" v-cloak>
        <div class="col-md-3 col-xs-12">
            @include('admin.components.menu')
        </div>
        <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="well">
                @yield('admin.content')
            </div>
        </div>
    </div>

    
@endsection