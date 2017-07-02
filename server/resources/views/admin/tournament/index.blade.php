@extends('admin.index')

@section('admin.content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="text-primary">Управление отборочным турниром</h4>
            <div class="row">
                <tournament inline-template :tournaments="{{ json_encode($tournaments) }}">
                    <div>
                        <ul class="nav nav-pills nav-stacked">
                            <li v-for="tournament in tournaments">@{{ tournament.name }}</li>
                        </ul>
                    </div>
                </tournament>
            </div>
        </div>
    </div>
@endsection