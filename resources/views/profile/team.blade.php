<div class="row">
    <team :user="user" inline-template>
        <div class="col-sm-12">
            <h4>Команда</h4>
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
            <button v-if="createTeam && !team" class="btn btn-primary btn-raised" data-toggle="modal" data-target="#createTeam">
                {{ trans('Создать команду') }}
            </button>
        </div>
    </team>

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