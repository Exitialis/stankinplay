@extends('admin.index')

@section('admin.content')
    <admin-users-show :user-prop="{{ $user->toJson() }}"
                      :update-url="'{{ route('api.users.roles.attach', $user->id) }}'"
                      :delete-url="'{{ route('api.users.roles.detach', $user->id) }}'"
                      :roles="{{ $roles }}"
                      :user-api-url="'{{ route('api.users.find', $user->id) }}'"
                      inline-template>
        <div>
            <h3>Пользователь <span class="text-primary">@{{ user.login }}</span></h3>

            <div class="row">
                <div class="col-sm-12">
                    <h4 class="text-primary">Основная информация</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>Логин</label>
                        <p>@{{ user.login }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>E-mail</label>
                        <p>@{{ user.email }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>Роли:</label>
                        <p>
                                    <span v-for="(role, index) in user.roles">
                                        @{{ role.display_name }} <span
                                                v-if="user.roles.length > 1 && index < (user.roles.length - 1)">,</span>
                                    </span>
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>Дисциплина</label>
                        <p>@{{ user.discipline.name }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>Фамилия</label>
                        <p>@{{ user.last_name }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>Имя</label>
                        <p>@{{ user.first_name }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>Отчество</label>
                        <p>@{{ user.middle_name }}</p>
                    </div>
                </div>
            </div>
            <div class="row" v-if="user.university_profile">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>Группа: </label>
                        <p>@{{ user.university_profile.group ? user.university_profile.group.name : 'Не указана' }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="form-group">
                        <label>Номер студенческого: </label>
                        <p>@{{ user.university_profile.studentID ? user.university_profile.studentID : 'Не Указан' }}</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6" data-toggle="tooltip" data-placement="top"
                     title="*Модуль по физической культуре. Выставляется тем, кто прошел отборочные испытания.">
                    <div class="form-group">
                        <label>Нужен модуль*</label>
                        <p v-if="user.university_profile.module">Да</p>
                        <p v-else>Нет</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @if( ! auth()->user()->hasRole('admin') && auth()->user()->hasRole('discipline_head'))
                    <div class="col-md-4 col-sm-4 col-xs-6" v-if="user.roles">
                        <button v-if="userRolesNames.indexOf('member') == -1" class="btn btn-success btn-raised" @click="setMemberRole()">Назначить игроком</button>
                        <button v-else class="btn btn-danger btn-raised" @click="removeMemberRole()">Удалить из игроков секции</button>
                    </div>
                @endif
            </div>
            @if(auth()->user()->hasRole('admin'))
                <form @submit.prevent="updateRoles()">
                    <h4>Управление ролями пользователя: </h4>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                {!! checkbox('form.' . $role->name, $role->display_name) !!}
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success btn-raised" :disabled="loading">
                        <i class="fa fa-spin fa-spinner" v-if="loading"></i> Сохранить
                    </button>
                </form>
            @endif
        </div>
    </admin-users-show>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection