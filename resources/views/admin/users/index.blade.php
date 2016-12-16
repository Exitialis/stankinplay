@extends('admin.index')

@section('admin.content')

    <admin-users :ajax-url="'{{ route('api.users') }}'" inline-template>
        <div>
            <h3>Пользователи</h3>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><a href="#" @click.prevent="sortBy('full_name')">ФИО</a></th>
                        <th><a href="#" @click.prevent="sortBy('group_id')">Группа</a></th>
                        <th><a href="#" @click.prevent="sortBy('discipline_name')">Дисциплина</a></th>
                        <th><a href="#" @click.prevent="sortBy('studentID')">Студенческий</a></th>
                        <th><a href="#" @click.prevent="sortBy('module')">Модуль</a></th>
                        <th><a href="#" @click.prevent="sortBy('budget')">Бюджет</a></th>
                        <th><a href="#" @click.prevent="sortBy('grants')">Стипендия</a></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users">
                        <td>@{{ user.full_name ? user.full_name : 'Не указана' }}</td>
                        <td>@{{ user.group_name ? user.group_name : 'Не указана' }}</td>
                        <td>@{{ user.discipline_name ? user.discipline_name : 'Не указана' }}</td>
                        <td>@{{ user.studentID ? user.studentID : 'Не указан' }}</td>
                        <td>
                            <i v-if="user.module" class="fa fa-check text-success" aria-hidden="true"></i>
                            <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                        </td>
                        <td>
                            <i v-if="user.budget" class="fa fa-check text-success" aria-hidden="true"></i>
                            <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                        </td>
                        <td>
                            <i v-if="user.grants" class="fa fa-check text-success" aria-hidden="true"></i>
                            <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <pagination :url="url"
                        v-model="users">
            </pagination>
        </div>
    </admin-users>

@endsection