<?php

namespace App\Services;

use GuzzleHttp\Client;

class TournamentGrid
{
    protected $client;

    protected $api_key;

    public function __construct()
    {
        $this->api_key = env('CHALLONGE_KEY');

        $this->client = new Client([
            'base_uri' => 'https://api.challonge.com/v1/'
        ]);
    }

    public function createTournament($name)
    {
        $response = $this->client->post('tournaments.json', [
            'form_params' => [
                'api_key' => $this->api_key,
                'tournament' => [
                    'name' => $name,
                    'hold_third_place_match' => true,
                    'ranked_by' => 'game wins',
                    'url' => 'stankinplay_' . $name
                ]
            ]
        ]);

        return $this->processResponse($response);
    }

    public function getTournament($tournamentID)
    {
        $response = $this->client->get("tournaments/$tournamentID.json", [
                'query' => [
                    'api_key' => $this->api_key
                ]
            ]);

        return $this->processResponse($response);
    }

    public function addParticipant($tournamentID, $name)
    {
        $response = $this->client->post("tournaments/$tournamentID/participants.json", [
            'form_params' => [
                'api_key' => $this->api_key,
                'participant' => [
                    'name' => $name
                ]
            ]
        ]);

        return $this->processResponse($response);
    }

    protected function processResponse($response)
    {
        return json_decode($response->getBody()->getContents());
    }
    
}