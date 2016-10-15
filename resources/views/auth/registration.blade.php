@extends('vendor.index')

<registration inline-template>
    <div>
        {!! title() !!}
        
        <form @submit.prevent="store('{{ route('registration.store') }}')" action="">

            {!! label(trans('Логин'), true) !!}
            {!! text('form.login', ['placeholder' => 'login', 'v-focus']) !!}

            {!! label(trans('E-mail'), true) !!}
            {!! input('email', 'form.email', ['placeholder' => 'test@mail.ru']) !!}

            {!! label(trans('Пароль'), true) !!}
            {!! text('form.password', ['type' => 'password']) !!}

            {!! label(trans('Фамилия'), true) !!}
            {!! text('form.lastName', ['placeholder' => 'Иванов']) !!}

            {!! label(trans('Имя'), true) !!}
            {!! text('form.firstName', ['placeholder' => 'Иван']) !!}

            {!! label(trans('Отчество'), true) !!}
            {!! text('form.middleName', ['placeholder' => 'Иванович']) !!}

            {!! label(trans('Группа в университете в формате XXX-11-11'), true) !!}
            {!! text('form.group', ['placeholder' => 'XXX-11-11']) !!}

            {!! checkbox('form.captain', trans('Я капитан')) !!}

            <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
                <i class="fa fa-spin fa-spinner" v-if="loading"></i> {{ trans('Зарегистрироваться') }}
            </button>


            <a href="{{ route('password.create') }}" class="text-muted small">
                {{ trans('resources-views-main-login.E0B9dO4SY9eEd3N97q007') }}
            </a>
        </form>
    </div>
</registration>