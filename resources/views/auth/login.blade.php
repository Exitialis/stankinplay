@extends('vendor.index')

@section('content')
    <login inline-template>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">
                        <h2>{{ trans('Авторизация') }}</h2>
                    </div>

                    <div class="panel-body">
                        <form autocomplete="off" class="form-horizontal" @submit.prevent="login('{{ route('login.post') }}')">

                            {!! text('form.login', trans('Логин'), true, ['placeholder' => 'login', 'horizontal' => 1]) !!}

                            {!! text('form.password', trans('Пароль'), true, ['type' => 'password', 'horizontal' => 1]) !!}

                            <div class="row">
                                <div class="col-sm-4 col-sm-offset-4">
                                    <button type="submit" class="btn btn-success btn-block" :disabled="loading">
                                        <i class="fa fa-spin fa-spinner" v-if="loading"></i> {{ trans('Войти') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </login>
@endsection