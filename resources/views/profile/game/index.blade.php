@extends('profile.index')

@section('profile')
    <game-profile inline-template>
        <div class="row">
            <div class="col-sm-12">
                <h4 class="text-primary">Дисциплина: CS:GO</h4>
                <h4>Ранг: <img src="https://csgo-stats.com/custom/img/ranks/15.png" alt="" style="max-width: 80px;"></h4>
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <label>Убийств</label>
                            <p>@{{ stats.kills }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <label>Смертей</label>
                            <p>@{{ stats.deaths }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <label>KDR</label>
                            <p>@{{ stats.kdr }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <label>Попаданий в голову</label>
                            <p>@{{ stats.headshots }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <label>Точность</label>
                            <p>@{{ stats.accuracy }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="form-group">
                            <label>Процент побед</label>
                            <p>@{{ stats.winRate }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </game-profile>
@endsection
