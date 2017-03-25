<?php

namespace Tests\Unit\Managers;

use App\Managers\ApiManager;
use App\Models\User;
use Tests\TestCase;

class ApiManagerTest extends TestCase
{
    public function testFindShouldReturnPaginatedResults()
    {
        $expected = [
            'data' => []
        ];

        //$user->getMock()->shouldReceive('where()->paginate()')->with(10)->andReturn($expected);

        $user = \Mockery::mock('App\Models\User')->shouldReceive('all')->andReturn([]);
        $request = \Request::shouldReceive('all')->andReturn([]);

        $manager = new ApiManager($user);



        $actual = $manager->find($request);

        $this->assertEquals($expected, $actual);
    }
}
