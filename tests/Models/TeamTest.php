<?php

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends DbTestCase
{
    public function testGetUser()
    {
        $team = Team::first();

        $actual = $team->users;

        $expected = User::where('team_id', $team->id)->get();

        $this->assertEquals($expected, $actual);
    }
}
