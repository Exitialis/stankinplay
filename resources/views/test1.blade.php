@extends('vendor.index')


@section('content')
    <test inline-template>
        <div class="well">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <a href="#" @click="request()" class="btn btn-raised btn-success btn-block">Тест</a>
                </div>
            </div>

        </div>

    </test>
@endsection