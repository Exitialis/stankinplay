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
                'name' => 'CS:GO',
                'max_players' => 16
            ]);
        }
        if ( ! Discipline::where('label', 'DOTA 2')->first()) {
            Discipline::create([
                'label' => 'DOTA 2',
                'name' => 'DOTA 2',
                'max_players' => 12
            ]);
        }
        if ( ! Discipline::where('label', 'LOL')->first()) {
            Discipline::create([
                'label' => 'LOL',
                'name' => 'League of Legends',
                'max_players' => 10
            ]);
        }
        if ( ! Discipline::where('label', 'HS')->first()) {
            Discipline::create([
                'label' => 'HS',
                'name' => 'Hearthstone',
                'team' => false,
                'max_players' => 2
            ]);
        }
        if ( ! Discipline::where('label', 'FIFA')->first()) {
            Discipline::create([
                'label' => 'FIFA',
                'name' => 'FIFA',
                'team' => false,
                'max_players' => 2
            ]);
        }
        if ( ! Discipline::where('label', 'WOT')->first()) {
            Discipline::create([
                'label' => 'WOT',
                'name' => 'World of Tanks',
                'max_players' => 30
            ]);
        }

        if ( ! Discipline::where('label', 'WT')->first()) {
            Discipline::create([
                'label' => 'WT',
                'name' => 'WarThunder',
                'max_players' => 15
            ]);
        }
    }
}
