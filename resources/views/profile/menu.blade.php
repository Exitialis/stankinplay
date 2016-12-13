<div class="well">
    <h4 class="text-center">Меню</h4>
    <div class="line"></div>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-stacked">
                <li :class="{active: currentTab === 'main'}">
                    <a href="#" @click.prevent="changeTab('main')">Информация</a>
                </li>
                <li :class="{active: currentTab === 'team'}">
                    <a href="#" @click.prevent="changeTab('team')">Команда</a>
                </li>
                {{--<li :class="{active: currentTab === 'gameProfile'}">
                    <a href="#" @click.prevent="changeTab('gameProfile')">Игровой профиль</a>
                </li>--}}
            </ul>
        </div>
    </div>
</div>