@extends('vendor.index')

@section('content')
    <reset-password :code="'{{ $code }}'" inline-template>
        <div v-cloak class="row">
            <div class="col-lg-6 col-lg-offset-3 col-xs-12">
                <div class="panel panel-warning">
                    <div class="panel-heading text-center">
                        <h4>{{ trans('Создание нового пароля') }}</h4>
                    </div>

                    <div class="panel-body">
                        <form autocomplete="off" class="form-horizontal" @submit.prevent="reset('{{ route('forgot.savePass') }}')">

                            {!! text('form.password', trans('Пароль'), true, ['type' => 'password', 'horizontal' => 1]) !!}
                            {!! text('form.password2', trans('Пароль'), true, ['type' => 'password', 'horizontal' => 1]) !!}

                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success btn-block" :disabled="loading">
                                        <i class="fa fa-spin fa-spinner" v-if="loading"></i> {{ trans('Сбросить пароль') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </reset-password>
@endsection
