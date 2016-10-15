@extends('vendor.index')

<registration inline-template>
    <div>
        <form @submit.prevent="store('{{ route('registration.store') }}')" action="">

            $table->string('login');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('group');

            {!! label(trans('Логин'), true) !!}
            {!! input('login', 'form.email', ['placeholder' => 'example@simex.global', 'v-focus']) !!}

            {!! label(trans('resources-views-main-login.uqZEcaogVpatyMXlTd84o'), true) !!}
            {!! text('form.password', ['type' => 'password']) !!}

            {!! checkbox('form.remember', trans('resources-views-main-login.S9MuVs1cLSquqbbKn3bhw')) !!}

            <div class="gutter">
                <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
                    <i class="fa fa-spin fa-spinner" v-if="loading"></i> {{ trans('resources-views-main-login.jrPdIy4u2QUmPPXU0PVy6') }}
                </button>
            </div>

            <a href="{{ route('password.create') }}" class="text-muted small">
                {{ trans('resources-views-main-login.E0B9dO4SY9eEd3N97q007') }}
            </a>
        </form>
    </div>
</registration>