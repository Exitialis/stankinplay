<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( ! Permission::where('name', 'create-team')->first()) {
            $perm = new Permission();

            $perm->name = 'create-team';
            $perm->description = "Возможность создавать команду";
            $perm->save();
        }

        if ( ! Permission::where('name', 'edit-team')->first()) {
            $perm = new Permission();

            $perm->name = 'edit-team';
            $perm->description = 'Возможность редакитровать команду';
            $perm->save();
        }
    }
}
