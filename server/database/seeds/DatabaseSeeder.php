<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DisciplineSeed::class);
        $this->call(GroupSeeder::class);
        $this->call(InviteStatusesSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeed::class);
        $this->call(TeamSeed::class);
    }
}
