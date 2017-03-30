<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\Flysystem\Exception;

class Deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy application changes for database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \DB::beginTransaction();
        /*
        if ( ! $this->removeOldTables()) {
            \DB::rollback();

            return false;
        }
        */

        \Artisan::call('migrate');

        if ( ! $this->moveUserTeamFieldToAnotherTable()) {
            \DB::rollBack();

            return false;
        }

        \DB::commit();

        $this->info('Деплой завершен');

        return true;
    }

    protected function removeOldTables()
    {
        $this->info('Начат процесс очистки старых таблиц');
        //Удаляем лишние таблицы

        if ( ! \DB::delete("delete from migrations where `migration` like  '%csgo%'")) {
            $this->error('Не удалось удалить данные из таблицы с миграциями');

            return false;
        }

        if ( ! \DB::delete("delete from migrations where `migration` like  '%steam%'")) {
            $this->error('Не удалось удалить данные из таблицы с миграциями');

            return false;
        }

        if ( ! \DB::delete("delete from migrations where `migration` LIKE '%add_additional%'")) {
            $this->error('Не удалось удалить миграцию с дополнительными полями для профиля пользователя');

            return false;
        }

        try {
            Schema::drop('csgo_profiles');
            Schema::drop('steam_profiles');
        } catch (Exception $e) {
            $this->error('Невозможно удалить таблицы');
            $this->error($e->getMessage());

            return false;
        }

        $this->info('База данных почищена');

        return true;
    }

    protected function moveUserTeamFieldToAnotherTable()
    {
        $users = \DB::table('users')->select('id as user_id', 'team_id')->where('team_id', '!=', 'null')->get();

        $users = collect($users)->map(function($x) {
            return (array) $x;
        })->toArray();

        \DB::table('user_team')->insert($users);

        try {
            \Schema::table('users', function(Blueprint $table) {
                $table->dropForeign('users_team_id_foreign');
                $table->dropColumn('team_id');
            });
        } catch(Exception $e) {
            $this->error('Невозможно удалить поле team_id');

            return false;
        }

        $this->info('Команды пользователей успешно перенесены');

        return true;

    }
}

