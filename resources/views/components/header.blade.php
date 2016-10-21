<navbar inline-template>
    <div class="navbar navbar-default header">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">StankinPlay</a>
            </div>

            <div class="navbar-collapse collapse navbar-inverse-collapse">
                <ul class="nav navbar-nav">
                    <li :class="{active: checkUrl('{{ route('registration.get') }}')}">
                        <a href="{{ route('registration.get') }}">Зарегистрироваться</a>
                    </li>
                    <li :class="{active: checkUrl('{{ route('login.get') }}')}">
                        <a href="{{ route('login.get') }}">Войти</a>
                    </li>
                    <li :class="{active: checkUrl('{{ route('profile.get') }}')}">
                        <a href="{{ route('profile.get') }}">Профиль</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li><a href="{{ route('profile.logout') }}">Выход</a></li>

                    {{--<li><a href="{{ route('profile.logout') }}">Вход</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</navbar>

