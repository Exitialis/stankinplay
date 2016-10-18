<?php

use App\Models\Discipline;
use Illuminate\Database\Seeder;

class DisciplineSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ( ! Discipline::where('name', 'CS:GO')->first()) {
            Discipline::create([
                'name' => 'CS:GO'
            ]);
        }
        if ( ! Discipline::where('name', 'DOTA 2')->first()) {
            Discipline::create([
                'name' => 'DOTA 2'
            ]);
        }
        if ( ! Discipline::where('name', 'LOL')->first()) {
            Discipline::create([
                'name' => 'LOL'
            ]);
        }
    }
}
