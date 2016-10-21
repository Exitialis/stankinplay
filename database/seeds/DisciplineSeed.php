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
        if ( ! Discipline::where('label', 'CS:GO')->first()) {
            Discipline::create([
                'label' => 'CS:GO',
                'name' => 'CS:GO'
            ]);
        }
        if ( ! Discipline::where('label', 'DOTA 2')->first()) {
            Discipline::create([
                'label' => 'DOTA 2',
                'name' => 'DOTA 2'
            ]);
        }
        if ( ! Discipline::where('label', 'LOL')->first()) {
            Discipline::create([
                'label' => 'LOL',
                'name' => 'League of Legends'
            ]);
        }
    }
}
