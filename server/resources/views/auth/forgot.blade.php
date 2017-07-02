@extends('vendor.index')

@section('content')
    <forgot inline-template>
        <div v-cloak class="row">
            <div class="col-lg-6 col-lg-offset-3 col-xs-12">
                <div class="panel panel-warning">
                    <div class="panel-heading text-center">
                        <h4>{{ trans('Восстановление пароля') }}</h4>
                    </div>

                    <div class="panel-body">
                        <form v-if=" ! success" autocomplete="off" class="form-horizontal" @submit.prevent="reset('{{ route('forgot') }}')">

                            {!! text('form.login', trans('Логин'), true, ['placeholder' => 'login', 'horizontal' => 1]) !!}

                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success btn-block" :disabled="loading">
                                        <i class="fa fa-spin fa-spinner" v-if="loading"></i> {{ trans('Сбросить пароль') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p v-else>Вам на почту было отправлено с письмом для подтверждения сброса пароля. Если сообещние не найдено, попробуйте проверить папку спам.</p>
                    </div>
                </div>
            </div>
        </div>
    </forgot>
@endsection
