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
                    <p>@{{ universityProfile.last_name }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Имя</label>
                    <p>@{{ universityProfile.first_name }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Отчество</label>
                    <p>@{{ universityProfile.middle_name }}</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6">
                <div class="form-group">
                    <label>Группа:</label>
                    <p>@{{ universityProfile.group.name }}</p>
                </div>
            </div>
        </div>
        <h4 class="text-primary">Дополнительная информация</h4>
        <div class="row">
            <form>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <div class="form-group">
                        <label>Модуль:</label>
                        <input type="checkbox" v-model="form.module">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

