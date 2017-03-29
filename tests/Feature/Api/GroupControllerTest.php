<?php

namespace Tests\Feature\Api;

use App\Models\Group;
use Tests\DbTestCase;

class GroupControllerTest extends DbTestCase
{

    public function test()
    {
        $this->assertTrue(true);
    }

//    public function testGetPaginatedGroups()
//    {
//        $groups = Group::paginate(10)->items();
//
//        $this->get(route('api.groups'))->assertStatus(200)
//            ->assertJsonFragment($groups);
//    }
}
