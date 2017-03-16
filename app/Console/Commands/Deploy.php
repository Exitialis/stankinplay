<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;

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
        \DB::transaction(function() {
            if( ! Role::where('name', 'discipline_head')->first()) {
                $disciplineHead = new Role();

                $disciplineHead->name = 'discipline_head';
                $disciplineHead->display_name = 'Ответственный';
                $disciplineHead->description = 'Ответственный за дисциплину';
                $disciplineHead->save();
            }
        });

        $this->info('Deploy completed');
    }
}
