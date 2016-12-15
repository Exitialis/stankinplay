@extends('admin.index')

@section('admin.content')

    <admin-users :ajax-url="'{{ route('api.users') }}" inline-template>
        <div>
            <h3>Пользователи</h3>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th @click="sortBy('last_name')">ФИО</th>
                        <th @click="sortBy('group_id')">Группа</th>
                        <th @click="sortBy('')">Дисциплина</th>
                        <th @click="sortBy">Студенческий</th>
                        <th @click="sortBy">Модуль</th>
                        <th @click="sortBy">Бюджет</th>
                        <th @click="sortBy">Стипендия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users">
                        <td>@{{ user.full_name }}</td>
                        <td>@{{ user.university_profile ? user.university_profile.group ? user.university_profile.group.name : 'Не указана' : 'Не указана' }}</td>
                        <td>@{{ user.discipline ? user.discipline.name : 'Не указана' }}</td>
                        <td>@{{ user.university_profile ? user.university_profile.studentID ? user.university_profile.studentID : 'Не указан' : 'Не указан' }}</td>
                        <td>
                            <p v-if=" ! user.university_profile">
                                <i class="fa fa-times text-danger" aria-hidden="true"></i>
                            </p>
                            <p v-else>
                                <i v-if="user.university_profile.module" class="fa fa-check text-success" aria-hidden="true"></i>
                                <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                            </p>
                        </td>
                        <td>
                            <p v-if=" ! user.university_profile">
                                <i class="fa fa-times text-danger" aria-hidden="true"></i>
                            </p>
                            <p v-else>
                                <i v-if="user.university_profile.budget" class="fa fa-check text-success" aria-hidden="true"></i>
                                <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                            </p>
                        </td>
                        <td>
                            <p v-if=" ! user.university_profile">
                                <i class="fa fa-times text-danger" aria-hidden="true"></i>
                            </p>
                            <p v-else>
                                <i v-if="user.university_profile.grants" class="fa fa-check text-success" aria-hidden="true"></i>
                                <i v-else class="fa fa-times text-danger" aria-hidden="true"></i>
                            </p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <pagination :url="ajaxUrl"
                        v-model="users">
            </pagination>
        </div>
    </admin-users>

@endsection