@extends('vendor.index')

@section('content')

    <div class="row" v-cloak>
        <div class="col-xs-12">
            <div class="jumbotron">
                <h2>Не найдено</h2>
                <p>Ой! Кажется, мы потеряли страницу. Но вы все еще можете вернуться на главную и попробовать снова</p>
                <p>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-raised">На главную</a>
                </p>
            </div>
        </div>
    </div>


@endsection