@extends('vendor.index')

@section('content')

    <div class="row" v-cloak>
        <div class="col-xs-12">
            <div class="jumbotron">
                <h2>Ошибка доступа</h2>
                <p>У вас недостаточно прав для просмотра данной страницы</p>
                <p>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-raised">На главную</a>
                </p>
            </div>
        </div>
    </div>


@endsection