<div class="row">
    <team :user="user" inline-template>
        <div v-if="team" class="col-sm-12">
            <h4 class="text-primary">Ваша команда</h4>
            <div  class="row">
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="form-group">
                        <label>Название</label>
                        <p>@{{ team.name }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="form-group">
                        <label>Дисциплина</label>
                        <p>@{{ team.discipline.name }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h4 class="text-success">Участники:</h4>
                </div>
                <div v-if="manageTeam" class="col-md-4">
                    <button v-if="manageTeam && team" class="btn btn-primary btn-raised" data-toggle="modal" data-target="#inviteUser">
                        {{ trans('Пригласить участника') }}
                    </button>
                </div>
            </div>

            <div v-if="team.members" class="row">
                <div class="col-sm-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Логин:</th>
                            <th>Фамилия:</th>
                            <th>Имя:</th>
                            <th>Отчество:</th>
                            <th>Группа:</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="member in team.members">
                            <td>@{{ member.login }}</td>
                            <td>@{{ member.last_name }}</td>
                            <td>@{{ member.first_name }}</td>
                            <td>@{{ member.middle_name }}</td>
                            <td>@{{ member.group }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button v-if="manageTeam && !team" class="btn btn-primary btn-raised" data-toggle="modal" data-target="#createTeam">
                {{ trans('Создать команду') }}
            </button>
        </div>
    </team>

    <invite-user inline-template>
        <div class="modal fade" id="createTeam" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{ trans('Новая команда') }}</h4>
                    </div>
                    <form class="form-horizontal" @submit.prevent="store('{{ route('team.store') }}')">
                        <div class="modal-body">
                            {!! text('form.name', trans('Название команды')) !!}


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('Создать') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </invite-user>

    <create-team inline-template>
        <div class="modal fade" id="createTeam" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{ trans('Новая команда') }}</h4>
                    </div>
                    <form class="form-horizontal" @submit.prevent="store('{{ route('team.store') }}')">
                        <div class="modal-body">
                            {!! text('form.name', trans('Название команды')) !!}

                            <select-list v-model="form.discipline" url="/disciplines" label="Дисциплина"></select-list>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('Создать') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </create-team>
</div>