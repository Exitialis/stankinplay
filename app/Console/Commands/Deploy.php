<?php

namespace App\Console\Commands;

use App\Http\Middleware\Role;
use App\Models\Group;
use App\Models\UniversityProfile;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Command;
use Masterminds\HTML5;
use PHPHtmlParser\Dom;

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
            $disciplineHead = new Role();

            $disciplineHead->name = 'discipline_head';
            $disciplineHead->display_name = 'Ответственный';
            $disciplineHead->description = 'Ответственный за дисциплину';
            $disciplineHead->save();
        });
    }
}
