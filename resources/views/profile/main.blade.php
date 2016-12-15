<div v-if="ready" class="row">
    <div class="col-sm-12">
        <h4 class="text-primary">Основная информация</h4>
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Логин</label>
                    <p>@{{ user.login }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>E-mail</label>
                    <p>@{{ user.email }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Роль:</label>
                    <p>
                        <span v-for="(role, index) in user.roles">
                            @{{ role.display_name }} <span v-if="user.roles.length > 1 && index < (user.roles.length - 1)">,</span>
                        </span>
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Дисциплина</label>
                    <p>@{{ user.discipline.name }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Фамилия</label>
                    <p>@{{ user.last_name }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Имя</label>
                    <p>@{{ user.first_name }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
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
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <div class="form-group">
                                <label>Группа:</label>
                                <v-select2 v-model="form.group_id" :ajax-url="'{{ route('api.users.groups.lists') }}'" :default-value="group"></v-select2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <label>&nbsp;</label>
                    {!! checkbox('form.module', trans('Нужен модуль')) !!}
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <label>&nbsp;</label>
                    {!! checkbox('form.budget', trans('Бюджет')) !!}
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <label>&nbsp;</label>
                    {!! checkbox('form.grants', trans('Стипендия')) !!}
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    {!! text('form.studentID', trans('Номер студенческого')) !!}
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <button type="submit" class="btn btn-success">
                        Сохранить
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

