@extends('vendor.index')

@section('content')
    <registration inline-template>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <h2>{{ trans('Регистрация в секцию киберспорта') }}</h2>
                    </div>

                    <div class="panel-body">
                        <form v-if="!user" autocomplete="off" class="form-horizontal" @submit.prevent="store('{{ route('registration.store') }}')">

                            {!! text('form.login', trans('Логин'), true, ['placeholder' => 'login', 'horizontal' => 1]) !!}

                            {!! input('email', 'form.email', trans('E-mail'), true, ['placeholder' => 'test@mail.ru', 'horizontal' => 1]) !!}

                            {!! text('form.password', trans('Пароль'), true, ['type' => 'password', 'horizontal' => 1]) !!}

                            {!! text('form.last_name', trans('Фамилия'), true, ['placeholder' => 'Иванов', 'horizontal' => 1]) !!}

                            {!! text('form.first_name', trans('Имя'), true, ['placeholder' => 'Иван', 'horizontal' => 1]) !!}

                            {!! text('form.middle_name', trans('Отчество'), true, ['placeholder' => 'Иванович', 'horizontal' => 1]) !!}

                            {!! text('form.group', trans('Группа'), true, ['placeholder' => 'XXX-11-11', 'horizontal' => 1]) !!}

                            {!! checkbox('form.captain', trans('Я капитан'), ['horizontal' => 1]) !!}

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

                            <button type="submit" class="btn btn-primary btn-raised btn-block" :disabled="loading">
                                <i class="fa fa-spin fa-spinner" v-if="loading"></i> {{ trans('Зарегистрироваться') }}
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </registration>
@endsection