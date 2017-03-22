<?php

namespace Tests;

use App\Models\Discipline;
use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationController extends DbTestCase
{
    public function testRegistrationPageOk()
    {
        $this->get(route('registration.get'))->assertStatus(200);
    }

    public function testRegistrationSuccessfully()
    {
        $discipline = Discipline::get()->random(1)->first();
        $group = Group::first();

        $login = $this->faker->userName;
        $email = $this->faker->safeEmail;
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $middleName = $this->faker->firstNameMale;

        $this->post(route('registration.store'), [
            'login' => $login,
            'email' => $email,
            'password' => '12345',
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'discipline' => $discipline->id,
            'group_id' => $group->id,
            'module' => 0
        ])->assertJson([
            'redirect' => route('login.get')
        ]);

        $id = User::where('login', $login)->first()->id;

        $this->assertDatabaseHas('users', [
            'login' => $login,
            'email' => $email,
            'password' => '12345',
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'discipline' => $discipline->id,
        ]);

        $this->assertDatabaseHas('university_profiles', [
            'user_id' => $id,
            'module' => 0,
            'group_id' => $group->id,
            'studentID' => null,
            'budget' => 0,
            'grants' => 0,
            'socialActivity' => 0,
            'gto' => 0,
            'anotherSections' => 0
        ]);

    }
}
