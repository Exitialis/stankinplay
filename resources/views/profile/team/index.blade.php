@extends('profile.index')

@section('profile')
    <div class="row">
        <profile-team inline-template>
            <div class="col-sm-12">
                <h3>Команда</h3>
                <p v-if=" ! user.discipline[0].team">В вашей дисциплине нет команд.</p>
                {{--   Приглашения в команду  --}}
                <div v-if="userInvites" class="row">
                    <div v-if="userInvites.length >= 1" class="col-sm-12">
                        <h4 class="text-info">У вас есть приглашения в команду:</h4>
                        <div class="row" v-for="(userInvite, index) in userInvites">
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <label>Пригласитель</label>
                                    <p>@{{ userInvite.inviter.login }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <div class="form-group">
                                    <label>Название команды</label>
                                    <p>@{{ userInvite.team.name }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <button @click.prevent="acceptInvite(index)" class="btn btn-success">
                                    Принять
                                </button>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <button @click.prevent="declineInvite(index)" class="btn btn-danger">
                                    Отклонить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--   Отображение команды  --}}
                <h4 v-if="team" class="text-primary">Ваша команда</h4>
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
                        <button v-if="manageTeam && team" class="btn btn-primary btn-raised" data-toggle="modal"
                                data-target="#inviteUser">
                            {{ trans('Пригласить участника') }}
                        </button>
                    </div>
                </div>
                {{--Участники команды--}}
                <div v-if="team" class="row">
                    <div v-if="team.members" class="col-sm-12">
                        <div class="table-responsive">
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
                </div>
                   {{--Приглашения в команду от самой команды --}}
                <div v-if="invites && manageTeam" class="row">
                    <div v-if="invites.length >= 1" class="col-sm-12">
                        <h4>Приглашения в команду</h4>
                        <div class="table-responsive">
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
                                    <td :class="{'text-success': invite.status.status === 'accepted', 'text-danger': invite.status.status === 'decline', 'text-info': invite.status.status === 'sended'  }">@{{ invite.status.display_status }}</td>
                                    <td>@{{ invite.created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <button v-if="manageTeam && !team" class="btn btn-primary btn-raised" data-toggle="modal"
                        data-target="#createTeam">
                    {{ trans('Создать команду') }}
                </button>
            </div>
        </profile-team>
        {{--   Приглашение пользователя  --}}
        <invite-user :team="'{{ $team }}'" inline-template>
            <div class="modal fade" id="inviteUser" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{{ trans('Пригласить участника') }}</h4>
                        </div>
                        <form v-if="team" class="form-horizontal"
                              @submit.prevent="send('{{ route('invites.sendInvite') }}')">
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

           {{--Создание команды  --}}
        <create-team inline-template>
            <div class="modal fade" id="createTeam" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
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
        </create-team>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection