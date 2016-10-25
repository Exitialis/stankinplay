<div class="row">
    <team inline-template>
        <div class="col-sm-12">
            <div v-if="userInvites" class="row">
                <div v-if="userInvites.length >= 1" class="col-sm-12">
                    <h4 class="text-info">У вас есть приглашения в команду:</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Пригласитель</th>
                            <th>Команда</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="userInvite in userInvites">
                            <td>@{{ userInvite.inviter.login }}</td>
                            <td>@{{ userInvite.team.name }}</td>
                            <td>
                                <button class="btn btn-success">Принять</button>
                            </td>
                            <td>
                                <button class="btn btn-error">Отклонить</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h4 class="text-primary">Ваша команда</h4>
            <div v-if="team" class="row">
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
            <div v-if="team" class="row">
                <div class="col-md-8">
                    <h4 class="text-success">Участники:</h4>
                </div>
                <div v-if="manageTeam" class="col-md-4">
                    <button v-if="manageTeam && team" class="btn btn-primary btn-raised" data-toggle="modal" data-target="#inviteUser">
                        {{ trans('Пригласить участника') }}
                    </button>
                </div>
            </div>

            <div v-if="team" class="row">
                <div v-if="team.members" class="col-sm-12">
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
            <div v-if="invites && manageTeam" class="row">
                <div v-if="invites.length >= 1" class="col-sm-12">
                    <h4>Приглашения в команду</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Логин</th>
                                <th>Статус приглашения</th>
                                <th>Дата приглашения</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="invite in invites">
                                <td>@{{ invite.invited.login }}</td>
                                <td>@{{ invite.status.display_status }}</td>
                                <td>@{{ invite.created_at }}</td>
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

    <invite-user v-if="manageTeam" inline-template>
        <div v-if="team" class="modal fade" id="inviteUser" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{ trans('Пригласить участника') }}</h4>
                    </div>
                    <form v-if="team" class="form-horizontal" @submit.prevent="send('{{ route('invites.sendInvite') }}')">
                        <div class="modal-body">
                            <select-list v-model="form.user_id" :options="options" label="Игрок"></select-list>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('Пригласить') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </invite-user>

    <create-team v-if="manageTeam" inline-template>
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

                            <select-list v-model="form.discipline" :options="options" label="Дисциплина"></select-list>
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