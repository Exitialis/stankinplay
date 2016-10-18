@extends('vendor.index')

@section('content')
    <login inline-template>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <h2>{{ trans('Профиль') }}</h2>
                    </div>

                    <div class="panel-body text-center">
                       <h1>Приветствую, {{ $user->login }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </login>
@endsection