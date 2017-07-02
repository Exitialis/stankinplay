@extends('profile.index')

@section('profile')
    <profile inline-template>
        <div v-if="ready" class="row">
            <div class="col-sm-12">
                <h4 class="text-primary">Основная информация</h4>
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
                            <label>Роль:</label>
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
                            <p>@{{ user.discipline[0].name }}</p>
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
                <h4 class="text-primary">Дополнительная информация</h4>
                <div class="row">
                    <form @submit.prevent="submit('{{ route('api.users.profile.university.update', auth()->id()) }}')">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Группа:</label>
                                        <v-select2 v-model="form.group_id" :ajax-url="'{{ route('api.groups.lists') }}'"
                                                   :default-value="group"></v-select2>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! text('form.studentID', trans('Номер студенческого')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12" data-toggle="tooltip" data-placement="top"
                                     title="*Модуль по физической культуре. Выставляется тем, кто прошел отборочные испытания.">
                                    {!! checkbox('form.module', trans('Нужен модуль*')) !!}
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! checkbox('form.budget', trans('Бюджет')) !!}
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! checkbox('form.grants', trans('Мне выплачивается стипендия')) !!}
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! checkbox('form.anotherSections', trans('Посещаю другие секции')) !!}
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    {!! checkbox('form.gto', trans('Хочу сдать ГТО')) !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! checkbox('form.socialActivity', trans('Хотел бы поучаствовать в организационной деятельности секции')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <button type="submit" class="btn btn-success">
                                Сохранить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </profile>
@endsection
