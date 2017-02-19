<?php

use App\Models\Discipline;
use App\Models\Group;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationTest extends DbTestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegistrationPostEndpoint()
    {

        $login = $this->faker->firstName;
        $discipline_id = Discipline::first()->id;
        $email = $this->faker->safeEmail;
        $name = $this->faker->lastName;
        $group_id = Group::first()->id;
        $password = '12345';
        //$captain_role_id = Role::where('name', 'captain')->first()->id;

        $this->post(route('registration.store'), [
            /*'login' => $login,
            'discipline_id' => $discipline_id,
            'email' => $email,
            'password' => $password,
            'first_name' => $name,
            'last_name' => $name,
            'middle_name' => $name,
            'group_id' => $group_id,
            'module' => true,
            'captain' => true*/
        ])->followRedirects();/*->followRedirects()->assertResponseOk()->seeInDatabase('users', [
            'login' => $login,
            'email' => $email,
            'password' => bcrypt($password),
        ])->seeInDatabase('university_profiles', [
            'first_name' => $name,
            'last_name' => $name,
            'middle_name' => $name,
            'group_id' => $group_id,
            'module' => true
        ]);*/

        dd($this->response->content());
    }
}
