<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
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

        if ( ! $this->removeOldTables()) {
            \DB::rollback();

            return;
        }

        \DB::commit();

        $this->info('Деплой завершен');
    }

    protected function removeOldTables()
    {
        $this->info('Начат процесс очистки старых таблиц');
        //Удаляем лишние таблицы

        if ((! \DB::delete("delete from migrations where `migration` like  '%create_csgo_profiles_table'") == 1)
            &&  (! \DB::delete("delete from migrations where `migration` like  '%create_steam_profiles_table'") == 1)
        ) {
            $this->error('Не удалось очистить таблицу с миграциями');

            return false;
        }

        if ( ! \DB::delete("delete from migrations where `migration` LIKE '%add_additional%' OR `migration` LIKE '%create_csgo%'")) {
            $this->error('Не удалось удалить миграцию с дополнительными полями для профиля пользователя');

            return false;
        }

        if ( ! Schema::drop('csgo_profiles') && ! Schema::drop('steam_profiles')) {
            $this->error('Невозможно удалить таблицы');

            return false;
        }

        try{
            //Удаляем файл с миграцией
            if ( ! unlink(database_path('migrations/2016_10_13_181235_create_csgo_profiles_table.php')) && ! unlink(database_path('migrations/2016_10_13_180647_create_steam_profiles_table.php'))) {
                $this->error('Невозможно удалить файл миграции. Откат базы данных');

                return false;
            }
        } catch(\ErrorException $e) {
            $this->error($e->getMessage());

            return false;
        }

        $this->info('База данных почищена');

        return true;
    }
}

