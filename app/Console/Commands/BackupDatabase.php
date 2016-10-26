<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup database';

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
        $host = config('database.connections.mysql.host');
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        
        $backupPath = config('database.backup_path');
        $filename = \Carbon\Carbon::now()->format('YmdHis');

        $command = "mysqldump -e -f -h $host -u $username -p$password $database > $backupPath$filename.sql";

        exec($command);

        \Storage::drive('s3')->put("/backups/$filename.sql", file_get_contents("$backupPath$filename.sql"));

        $this->info('Backup Completed!');
        $this->info('Filename:' . $backupPath.$filename);
    }
}
