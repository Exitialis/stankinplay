<div class="well">
    <h4 class="text-center">Меню</h4>
    <div class="line"></div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-stacked">
                <li class="{{ active_link('profile.get', 'active') }}">
                    <a href="{{ route('profile.get') }}">Информация</a>
                </li>
                <li class="{{ active_link('profile.team', 'active') }}">
                    <a href="{{ route('profile.team') }}" >Команда</a>
                </li>
            </ul>
        </div>
    </div>
</div>