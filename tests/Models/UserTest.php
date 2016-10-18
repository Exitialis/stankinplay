<?php

use App\Models\Team;
use App\Models\User;

class UserTest extends DbTestCase
{
    /**
     * @test
     */
    public function getTeamsTest()
    {
        $user = User::first();

        $actual = $user->team;

        $expected = Team::find($user->team_id);

        $this->assertEquals($expected, $actual);
    }
}
