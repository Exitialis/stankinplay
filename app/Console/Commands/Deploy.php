<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
        //Удаляем лишние таблицы
        \DB::transaction(function() {
            \DB::table('migrations')->where('migration', 'LIKE', '%create_csgo_profiles_table')->update(['batch' => '6']);

            if (Artisan::call('migrate:rollback')) {
                //Удаляем файл с миграцией
                unlink(database_path('migrations/2016_10_13_181235_create_csgo_profiles_table.php'));
            }
        });
    }
}

