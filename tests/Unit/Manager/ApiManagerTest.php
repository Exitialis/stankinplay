<?php

namespace Tests\Unit\Manager;

use App\Managers\ApiManager;
use App\Models\User;
use Mockery;
use Tests\DbTestCase;

class ApiManagerTest extends DbTestCase
{
//    public function tearDown()
//    {
//        Mockery::close();
//
//        parent::tearDown();
//    }
//
//    public function testFindMethodShouldReturnPaginatedListOfResultsFromModel()
//    {
//        $userMock = Mockery::mock(User::class);
//
//        $userMock->shouldReceive('getVisible')
//                ->andReturn([]);
//
//        $userMock->shouldReceive('where->paginate')
//                ->with(10)
//                ->andReturn(true);
//
//        $inputs = [];
//
//        $apiManager = new ApiManager($userMock);
//
//        $this->assertTrue($apiManager->find($inputs));
//    }
//
//    public function testFindMethodShouldFilterModelsByGivenParameters()
//    {
//        $userMock = Mockery::mock(User::class);
//
//        $firstName = 'te';
//        $lastName = 'z';
//
//        $inputs = [
//            'first_name' => $firstName,
//            'last_name' => $lastName
//        ];
//
//        $userMock->shouldReceive('getVisible')
//                ->andReturn(['first_name', 'last_name', 'middle_name']);
//
//        $userMock->shouldReceive('where->paginate')
//                ->with([
//                    ['first_name', 'LIKE', 'te%'],
//                    ['last_name', 'LIKE', 'z%']
//                ])->with(10)
//                ->andReturn(true);
//
//        $apiManager = new ApiManager($userMock);
//
//        $this->assertTrue($apiManager->find($inputs));
//    }
//
//    public function testFindMethodShouldLoadRelationsForModel()
//    {
//        $userMock = Mockery::mock(User::class);
//
//        $relations = [
//            'group', 'university_profile'
//        ];
//
//        $inputs['relations'] = $relations;
//
//        $userMock->shouldReceive('getVisible')
//                ->andReturn([]);
//
//        $userMock->shouldReceive('where->with->paginate')
//                ->with($relations)
//                ->andReturn(true);
//
//        $apiManager = new ApiManager($userMock);
//
//        $this->assertTrue($apiManager->find($inputs));
//    }
}
