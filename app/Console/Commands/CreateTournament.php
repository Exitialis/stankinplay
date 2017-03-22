<?php

namespace App\Console\Commands;

use App\Models\Discipline;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\User;
use App\Services\TournamentGrid;
use Illuminate\Console\Command;

class CreateTournament extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournament:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a tournament';

    protected $api;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->api = new TournamentGrid();

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $disciplines = Discipline::get();

        $name = $this->argument('name');

        foreach ($disciplines as $discipline) {
            $disciplineName = str_replace(':', '_', $discipline->label);
            $disciplineName = str_replace(' ', '_', $disciplineName);

            $response = $this->api->createTournament($name, $disciplineName)->tournament;

            $tournament = new Tournament();
            $tournament->name = $name;
            $tournament->challonge_id = $response->id;
            $tournament->discipline_id = $discipline->id;
            $tournament->live_image_url = $response->live_image_url;
            $tournament->full_challonge_url = $response->full_challonge_url;
            $tournament->save();

            $this->registerTeams($discipline, $tournament);
        }
    }

    protected function registerTeams($discipline, Tournament $tournament)
    {
        if ( ! $discipline->team) {
            $members = User::where('discipline_id', $discipline->id)->get();

            foreach ($members as $member) {
                $this->api->addParticipant($tournament->challonge_id, $member->login);
            }

            return true;
        }

        $teams = Team::where('discipline_id', $discipline->id)->has('members', '>=', 5)->get();

        foreach ($teams as $team) {
            $this->api->addParticipant($tournament->challonge_id, $team->name);
        }

        return true;
    }


}
