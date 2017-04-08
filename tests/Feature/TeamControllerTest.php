<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Tests\DbTestCase;

class TeamControllerTest extends DbTestCase
{
    public function test()
    {
        $this->assertTrue(true);
    }

    /*public function testGetUsersForTeam()
    {
        $team = Team::first();

        $this->get(route('team.users.get', $team->id));
    }

    public function testGetTeams()
    {
        $this->actingAs(User::first());

        $team = User::first()->team()->first()->toJson();

        $this->get(route('team.get'))->assertStatus(200)->assertJson($team);
    }*/
}
