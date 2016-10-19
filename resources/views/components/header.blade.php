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
                <li class="active">
                    <a href="{{ route('registration.get') }}">Регистрация</a>
                </li>
                <li>
                    <a href="{{ route('profile.get') }}">Профиль</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                @if ($auth)
                    <li><a href="{{ route('profile.logout') }}">Выход</a></li>
                @else
                    <li><a href="{{ route('profile.logout') }}">Вход</a></li>
                @endif
                {{--<li class="dropdown">--}}
                    {{--<a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown--}}
                        {{--<b class="caret"></b></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="#">Action</a></li>--}}
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</div>