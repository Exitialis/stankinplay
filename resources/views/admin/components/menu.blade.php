<div class="well">
    <h4 class="text-center">Меню</h4>
    <div class="line"></div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-stacked text-center">
                <li class="{{ active_link('admin.users') }}">
                    <a href="{{ route('admin.users') }}">Пользователи</a>
                </li>
                <li class="{{ active_link('admin.news') }}">
                    <a href="{{ route('admin.news') }}">Новости</a>
                </li>
            </ul>
        </div>
    </div>
</div>

