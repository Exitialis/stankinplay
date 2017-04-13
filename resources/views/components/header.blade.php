<navbar inline-template>
    <div v-cloak class="navbar navbar-default header">
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
                    @if(auth()->check())
                        <li v-if="user" :class="{active: checkUrl('{{ route('profile.get') }}')}">
                            <a href="{{ route('profile.get') }}">Профиль</a>
                        </li>
                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('moderator') || auth()->user()->hasRole('discipline_head'))
                            <li :class="{active: checkUrl('{{ route('admin') }}')}">
                                <a href="{{ route('admin') }}">Управление секцией</a>
                            </li>
                        @endif
                    @endif
                    <li :class="{active: checkUrl('{{ route('team') }}')}">
                        <a href="{{ route('team') }}">Команды</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li v-if="!user" :class="{active: checkUrl('{{ route('registration.get') }}')}">
                        <a href="{{ route('registration.get') }}">Зарегистрироваться</a>
                    </li>
                    <li v-if="!user" :class="{active: checkUrl('{{ route('login.get') }}')}">
                        <a href="{{ route('login.get') }}">Войти</a>
                    </li>

                    <li v-if="user"><a href="{{ route('profile.logout') }}">Выход</a></li>
                </ul>
            </div>
        </div>
    </div>
</navbar>

