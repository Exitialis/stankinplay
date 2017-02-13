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
                'name' => 'CS:GO',
                'name' => 'CS:GO'
            ]);
        }
        if ( ! Discipline::where('name', 'DOTA 2')->first()) {
            Discipline::create([
                'name' => 'DOTA 2',
                'name' => 'DOTA 2'
            ]);
        }
        if ( ! Discipline::where('name', 'LOL')->first()) {
            Discipline::create([
                'name' => 'LOL',
                'name' => 'League of Legends'
            ]);
        }
        if ( ! Discipline::where('name', 'HS')->first()) {
            Discipline::create([
                'name' => 'HS',
                'name' => 'Hearthstone',
                'team' => false
            ]);
        }
        if ( ! Discipline::where('name', 'FIFA')->first()) {
            Discipline::create([
                'name' => 'FIFA',
                'name' => 'FIFA',
                'team' => false
            ]);
        }
        if ( ! Discipline::where('name', 'WOT')->first()) {
            Discipline::create([
                'name' => 'WOT',
                'name' => 'World of Tanks'
            ]);
        }

        if ( ! Discipline::where('name', 'WT')->first()) {
            Discipline::create([
                'name' => 'WT',
                'name' => 'WarThunder'
            ]);
        }
    }
}
