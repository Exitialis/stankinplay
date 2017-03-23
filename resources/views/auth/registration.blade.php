@extends('vendor.index')

@section('content')
    <registration inline-template>
        <div v-cloak class="row">
            <div class="col-lg-6 col-lg-offset-3 col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading text-center">
                        <h4>{{ trans('Регистрация в секцию киберспорта') }}</h4>
                    </div>

                    <div class="panel-body">
                        <form v-if="!registration" autocomplete="off" class="form-horizontal" @submit.prevent="store('{{ route('registration.store') }}')">

                            {!! text('form.login', trans('Логин'), true, ['placeholder' => 'login', 'horizontal' => 1]) !!}

                            {!! input('email', 'form.email', trans('E-mail'), true, ['placeholder' => 'test@mail.ru', 'horizontal' => 1]) !!}

                            {!! text('form.password', trans('Пароль'), true, ['type' => 'password', 'horizontal' => 1]) !!}

                            {!! text('form.last_name', trans('Фамилия'), true, ['placeholder' => 'Иванов', 'horizontal' => 1]) !!}

                            {!! text('form.first_name', trans('Имя'), true, ['placeholder' => 'Иван', 'horizontal' => 1]) !!}

                            {!! text('form.middle_name', trans('Отчество'), true, ['placeholder' => 'Иванович', 'horizontal' => 1]) !!}

                            {!! select('form.discipline', 'disciplines', trans('Дисциплина'), 'true', ['horizontal' => 1]) !!}

                            <div class="form-group">
                                <label class="control-label col-sm-2">Группа:</label>
                                <div class="col-sm-10">
                                    <label>&nbsp;</label>
                                    <v-select2 v-model="form.group_id" :ajax-url="'{{ route('api.groups.lists') }}'"></v-select2>
                                </div>
                            </div>

                            {!! checkbox('form.captain', trans('Я капитан'), ['horizontal' => 1]) !!}

                            {!! checkbox('form.module', trans('Нужен модуль'), ['horizontal' => 1]) !!}

                           {{-- <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-2">
                                        {!! Recaptcha::render() !!}
                                    </div>
                                    @if($errors->has('g-recaptcha-response'))
                                        <div class="help-block">{{ $errors->get('g-recaptcha-response')[0] }}</div>
                                    @endif
                                </div>
                            </div>--}}
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success btn-block" :disabled="loading">
                                        <i class="fa fa-spin fa-spinner" v-if="loading"></i> {{ trans('Зарегистрироваться') }}
                                    </button>
                                </div>
                            </div>


                        </form>
                        <div v-else>
                            <h3>Вы успешно зарегестрированы в секции киберспорта.</h3>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </registration>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
@endsection