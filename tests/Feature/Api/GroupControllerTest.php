<?php

namespace Tests\Feature\Api;

use App\Models\Group;
use Tests\DbTestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupControllerTest extends DbTestCase
{
    public function testGetPaginatedGroups()
    {
        $groups = Group::paginate(10)->items();

        $this->get(route('api.groups'))->assertStatus(200)
            ->assertJson($groups);
    }

//    public function testFindGroupsByName()
//    {
//
//
//        $this->get(route('api.groups.lists', [
//            'q' => 'ИДБ-14-1'
//        ]))->assertStatus(200)
//            ->assertJsonFragment([
//                [
//                    "text" => "ИДБ-14-1",
//                    "id" => 2
//                ],
//                [
//                    "text" => "ИДБ-14-10",
//                    "id" => 11
//                ],
//                [
//                    "text" => "ИДБ-14-11",
//                    "id" => 12
//                ],
//                [
//                    "text" => "ИДБ-14-12",
//                    "id" => 13
//                ],
//                [
//                    "text" => "ИДБ-14-13",
//                    "id" => 14
//                ],
//                [
//                    "text" => "ИДБ-14-14",
//                    "id" => 15
//                ],
//                [
//                    "text" => "ИДБ-14-15",
//                    "id" => 16
//                ],
//                [
//                    "text" => "ИДБ-14-16",
//                    "id" => 17
//                ],
//                [
//                    "text" => "ИДБ-14-17",
//                    "id" => 18
//                ],
//                [
//                    "text" => "ИДБ-14-18",
//                    "id" => 19
//                ],
//            ]);
//    }
}
