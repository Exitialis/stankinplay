<?php

namespace Tests\Feature\Unit\Manager;

use App\Managers\ApiManager;
use App\Models\User;
use Tests\DbTestCase;

class ApiManagerTest extends DbTestCase
{
    public function testFindMethodShouldReturnPaginatedListOfResultsFromModel()
    {
        $users = User::paginate(10);

        $inputs = [];

        $apiManager = new ApiManager(new User());

        $this->assertEquals($users, $apiManager->find($inputs));
    }

    public function testFindMethodShouldFilterUsersByGivenParameters()
    {
        $filter['first_name'] = 'iv';
        $filter['relations'] = [
            'university_profile' => [
                'relations' => [
                    'group' => [
                        'name' => 'test',
                    ]
                ]
            ]
        ];

        $users = User::where('first_name', 'LIKE', 'iv%')->with(['university_profile' => function($query) {
            $query->with(['group' => function($query) {
                $query->where('name', 'LIKE', 'test');
            }]);
        }])->paginate(10);

        $apiManager = new ApiManager(new User());

        $this->assertEquals($users, $apiManager->find($filter));
    }
}
