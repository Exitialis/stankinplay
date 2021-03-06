<?php

namespace App\Console;

use App\Console\Commands\BackupDatabase;
use App\Console\Commands\CreateTournament;
use App\Console\Commands\Deploy;
use App\Console\Commands\ImportStats;
use App\Console\Commands\LastBaseImporter;
use App\Console\Commands\MakeRepositoryCommand;
use App\Console\Commands\MakeRepositoryContractCommand;
use App\Console\Commands\ParseCsv;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        MakeRepositoryContractCommand::class,
        MakeRepositoryCommand::class,
        BackupDatabase::class,
        CreateTournament::class,
        ParseCsv::class,
        Deploy::class,
        LastBaseImporter::class,
        ImportStats::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('db:backup')
//                  ->at('14:55');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
