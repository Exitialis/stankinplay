<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class TeamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        factory(Team::class, 5)->create([
            'captain_id' => $user->id
        ]);
    }
}
