@extends('admin.index')

@section('admin.content')

    <admin-users :ajax-url="'{{route('api.users.filter')}}'" :disciplines-url="'{{ route('api.disciplines') }}'"
                 :export-url="'{{ route('api.users.export') }}'"
                 inline-template>
        <div>
            <h3>Пользователи</h3>

            <div class="modal fade" id="filter" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">{{ trans('Фильтр') }}</h4>
                        </div>
                        <form class="form-horizontal" autocomplete="off" @submit.prevent="filter">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Группа:</label>
                                    <div class="col-sm-10">
                                        <v-select2 v-model="form.group_id" :ajax-url="'{{ route('api.users.groups.lists') }}'"></v-select2>
                                    </div>
                                </div>

                                @if( ! auth()->user()->hasRole('discipline_head') && auth()->user()->hasRole('admin'))
                                    {!! select('form.discipline_id', 'disciplines', trans('Дисциплина'), 'true', ['horizontal' => 1]) !!}
                                @endif
                                {!! text('form.studentID', trans('Номер студенческого'), 'true', ['horizontal' => 1]) !!}
                                {!! checkbox('form.onlyMembers', trans('Только участники секции')) !!}
                                {!! checkbox('form.module', trans('Модуль')) !!}
                                {!! checkbox('form.budget', trans('Бюджет')) !!}
                                {!! checkbox('form.grants', trans('Стипендия')) !!}
                                {!! checkbox('form.anotherSections', trans('Другие секции')) !!}
                                {!! checkbox('form.gto', trans('ГТО')) !!}
                                {!! checkbox('form.socialActivity', trans('Участие в организационной деятельности')) !!}
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success btn-block" :disabled="loading">
                                    <i class="fa fa-spin fa-spinner" v-if="loading"></i> {{ trans('Фильтровать') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <button class="btn btn-primary btn-raised" data-toggle="modal" data-target="#filter">
                        {{ trans('Фильтровать') }}
                    </button>
                </div>
                <div class="col-sm-3">
                    @if(auth()->user()->hasRole('admin'))
                        <form action="{{ route('api.users.export') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" v-for="(value, key) in form" v-if="value" :value="value" :name="key">
                            <button class="btn btn-primary btn-raised" data-toggle="modal">
                                {{ trans('Экспорт') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ФИО</th>
                        <th>Группа</th>
                        <th>Дисциплина</th>
                        <th>Студенческий</th>
                        <th>Модуль</th>
                        <th>Бюджет</th>
                        <th>Стипендия</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users">
                        <td>@{{ user.full_name ? user.full_name : 'Не указана' }}</td>
                        <td>@{{ user.university_profile ? user.university_profile.group ? user.university_profile.group.name  : 'Не указана' : 'Не указана' }}</td>
                        <td>@{{ user.discipline ? user.discipline.name : 'Не указана' }}</td>
                        <td>@{{ user.university_profile ? user.university_profile.studentID ? user.university_profile.studentID  : 'Не указана' : 'Не указана' }}</td>
                        <td v-if="user.university_profile">
                            <i v-if="user.university_profile.module" class="fa fa-check text-success" aria-hidden="true"></i>
                            <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                        </td>
                        <td v-if="user.university_profile">
                            <i v-if="user.university_profile.budget" class="fa fa-check text-success" aria-hidden="true"></i>
                            <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                        </td>
                        <td v-if="user.university_profile">
                            <i v-if="user.university_profile.grants" class="fa fa-check text-success" aria-hidden="true"></i>
                            <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                        </td>
                        <td>
                            <a :href="'{{ route('admin') }}' + '/users/' + user.id" >
                                <i class="fa fa-pencil text-success" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <pagination
                    :current="currentPage"
                    :total-pages="totalPages"
                    :per-page="perPage"
            @page-changed="fetchUsers"
            ></pagination>
        </div>
    </admin-users>

@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection