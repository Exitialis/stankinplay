<?php

use App\Models\Discipline;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationController extends DbTestCase
{
    public function testRegistrationPageOk()
    {
        $this->get(route('registration.get'))->assertResponseOk();
    }

    public function testRegistrationSuccessfully()
    {
        $discipline = Discipline::get()->random(1);

        $login = $this->faker->userName;
        $email = $this->faker->safeEmail;
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $middleName = $this->faker->firstNameMale;

        $this->post('/auth/registration', [
            'login' => $login,
            'email' => $email,
            'password' => '12345',
            'first_name' => $firstName,
            'last_name' => $lastName,
            'middle_name' => $middleName,
            'discipline' => $discipline->id
        ])->followRedirects();

        dd($this->response->getContent());

    }
}
