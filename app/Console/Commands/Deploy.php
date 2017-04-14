<?php

namespace App\Console\Commands;

use App\Models\Discipline;
use App\Models\User;
use DisciplineSeed;
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
        return \DB::transaction(function() {
            Schema::table('disciplines', function(Blueprint $table) {
                $table->integer('max_players')->unsigned()->after('name');
            });

            $this->removeOldTables();

            \Artisan::call('migrate');

            $this->moveUserTeamFieldToAnotherTable();

            $this->moveUserDisciplineFieldToAnotherTable();

            $user = User::with(['universityProfile'])->first();

            $user->universityProfile->studentID = 114231;
            $user->universityProfile->save();

            \DB::unprepared('ALTER TABLE `university_profiles` MODIFY `studentID` INT(10) unsigned NULL DEFAULT null');

            $this->runDisciplineSeed();

            $this->info('Деплой завершен');

            return true;
        });
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

    protected function runDisciplineSeed()
    {
        if ( ! Discipline::where('label', 'CS:GO')->first()) {
            Discipline::create([
                'label' => 'CS:GO',
                'name' => 'CS:GO',
                'max_players' => 16
            ]);
        }
        if ( ! Discipline::where('label', 'DOTA 2')->first()) {
            Discipline::create([
                'label' => 'DOTA 2',
                'name' => 'DOTA 2',
                'max_players' => 12
            ]);
        }
        if ( ! Discipline::where('label', 'LOL')->first()) {
            Discipline::create([
                'label' => 'LOL',
                'name' => 'League of Legends',
                'max_players' => 10
            ]);
        }
        if ( ! Discipline::where('label', 'HS')->first()) {
            Discipline::create([
                'label' => 'HS',
                'name' => 'Hearthstone',
                'team' => false,
                'max_players' => 2
            ]);
        }
        if ( ! Discipline::where('label', 'FIFA')->first()) {
            Discipline::create([
                'label' => 'FIFA',
                'name' => 'FIFA',
                'team' => false,
                'max_players' => 2
            ]);
        }
        if ( ! Discipline::where('label', 'WOT')->first()) {
            Discipline::create([
                'label' => 'WOT',
                'name' => 'World of Tanks',
                'max_players' => 30
            ]);
        }

        if ( ! Discipline::where('label', 'WT')->first()) {
            Discipline::create([
                'label' => 'WT',
                'name' => 'WarThunder',
                'max_players' => 15
            ]);
        }
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

    protected function moveUserDisciplineFieldToAnotherTable()
    {
        $users = \DB::table('users')->select('id as user_id', 'discipline_id')->get();

        $users = collect($users)->map(function($x) {
            return (array) $x;
        })->toArray();

        \DB::table('user_discipline')->insert($users);

        try {
            \Schema::table('users', function(Blueprint $table) {
                $table->dropForeign('users_discipline_id_foreign');
                $table->dropColumn('discipline_id');
            });
        } catch(Exception $e) {
            $this->error('Невозможно удалить поле discipline_id');

            return false;
        }

        $this->info('Дисциплины пользователей успешно перенесены');
    }
}

