@extends('vendor.index')

@section('content')

    <div class="row panel panel-success">
        <div class="panel-heading">
            <h1>Список команд</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <teams inline-template>
                    <div class="col-sm-12">

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Название</th>
                                    <th>Дисциплина</th>
                                    <th>Капитан</th>
                                    <th>Количество игроков</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(team, index) in teams">
                                    <td>@{{ team.name }}</td>
                                    <td>@{{ team.discipline.name }}</td>
                                    <td>@{{ team.captain.full_name }}</td>
                                    <td>@{{ membersCount(index) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <pagination
                                :current="currentPage"
                                :total-pages="totalPages"
                                :per-page="perPage"
                        @page-changed="fetchTeams"
                        ></pagination>
                    </div>
                </teams>
            </div>
        </div>
    </div>

@endsection