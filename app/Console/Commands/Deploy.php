<?php

namespace App\Console\Commands;

use App\Models\Discipline;
use App\Models\Permission;
use App\Models\Role;
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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $createNewsPermission = Permission::where('name', 'create-news')->first();

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->attachPermissions([$createNewsPermission]);
    }
}

