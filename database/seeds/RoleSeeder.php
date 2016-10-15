<?php

use App\Repositories\Contracts\RoleRepositoryContract;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = app(RoleRepositoryContract::class);
        
        $roles->create();
    }
}
